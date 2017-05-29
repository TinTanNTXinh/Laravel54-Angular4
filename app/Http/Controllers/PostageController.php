<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PostageRepositoryInterface;
use App\Repositories\FormulaSampleRepositoryInterface;
use App\Repositories\FormulaRepositoryInterface;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\UnitRepositoryInterface;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Common\DateTimeHelper;
use App\Common\AuthHelper;
use Route;
use DB;
use League\Flysystem\Exception;

class PostageController extends Controller implements ICrud, IValidate
{
    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;

    protected $postageRepo, $formulaSampleRepo, $customerRepo, $unitRepo, $formulaRepo;

    public function __construct(PostageRepositoryInterface $postageRepo
        , FormulaSampleRepositoryInterface $formulaSampleRepo
        , CustomerRepositoryInterface $customerRepo
        , UnitRepositoryInterface $unitRepo
        , FormulaRepositoryInterface $formulaRepo)
    {
        $this->postageRepo       = $postageRepo;
        $this->formulaSampleRepo = $formulaSampleRepo;
        $this->customerRepo      = $customerRepo;
        $this->unitRepo          = $unitRepo;
        $this->formulaRepo       = $formulaRepo;

        $jwt_data = AuthHelper::getCurrentUser();
        if ($jwt_data['status']) {
            $user_data = AuthHelper::getInfoCurrentUser($jwt_data['user']);
            if ($user_data['status'])
                $this->user = $user_data['user'];
        }

        $current_month   = DateTimeHelper::getFirstDayLastDay();
        $this->first_day = $current_month['first_day'];
        $this->last_day  = $current_month['last_day'];
        $this->today     = $current_month['today'];

        $this->table_name = 'postage';
        $this->skeleton   = $this->postageRepo->allSkeleton();
    }

    /** ===== API METHOD ===== */
    public function getReadAll()
    {
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 200);
    }

    public function getReadOne()
    {
        $id  = Route::current()->parameter('id');
        $one = $this->readOne($id);
        return response()->json($one, 200);
    }

    public function postCreateOne(Request $request)
    {
        $data      = $request->input($this->table_name);
        $validates = $this->validateInput($data);
        if (!$validates['status'])
            return response()->json(['msg' => $validates['errors']], 404);

        if (!$this->createOne($data))
            return response()->json(['msg' => ['Create failed!']], 404);
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 201);
    }

    public function putUpdateOne(Request $request)
    {
        $data      = $request->input($this->table_name);
        $validates = $this->validateInput($data);
        if (!$validates['status'])
            return response()->json(['msg' => $validates['errors']], 404);

        if (!$this->updateOne($data))
            return response()->json(['msg' => ['Update failed!']], 404);
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 200);
    }

    public function patchDeactivateOne(Request $request)
    {
        $id = $request->input('id');
        if (!$this->deactivateOne($id))
            return response()->json(['msg' => 'Deactivate failed!'], 404);
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 200);
    }

    public function deleteDeleteOne(Request $request)
    {
        $id = Route::current()->parameter('id');
        if (!$this->deleteOne($id))
            return response()->json(['msg' => 'Delete failed!'], 404);
        $arr_datas = $this->readAll();
        return response()->json($arr_datas, 200);
    }

    public function getSearchOne()
    {
        $filter    = (array)json_decode($_GET['query']);
        $arr_datas = $this->searchOne($filter);
        return response()->json($arr_datas, 200);
    }

    /** ===== LOGIC METHOD ===== */
    public function readAll()
    {
        $all = $this->skeleton->get();

        $customers       = $this->customerRepo->allActive();
        $units           = $this->unitRepo->allActive();
        $formula_samples = $this->formulaSampleRepo->allActive();

        return [
            'postages'        => $all,
            'customers'       => $customers,
            'units'           => $units,
            'formula_samples' => $formula_samples
        ];
    }

    public function readOne($id)
    {
        $one = $this->postageRepo->oneSkeleton($id)->first();

        return [
            'postage' => $one
        ];
    }

    public function createOne($data)
    {
        $i_postage  = $data['postage'];
        $i_formulas = $data['formulas'];

        try {
            DB::beginTransaction();

            $i_one = [
                'code'             => $this->postageRepo->generateCode('POSTAGE'),
                'unit_price'       => $i_postage['unit_price'],
                'delivery_percent' => $i_postage['delivery_percent'],
                'apply_date'       => DateTimeHelper::toStringDateTimeClientForDB($i_postage['apply_date']),
                'change_by_fuel'   => false,
                'note'             => $i_postage['note'],
                'created_by'       => $this->user->id,
                'updated_by'       => 0,
                'created_date'     => date('Y-m-d H:i:s'),
                'updated_date'     => null,
                'active'           => true,
                'customer_id'      => $i_postage['customer_id'],
                'unit_id'          => $i_postage['unit_id'],
                'fuel_id'          => $i_postage['fuel_id']
            ];

            $one = $this->postageRepo->create($i_one);

            if (!$one) {
                DB::rollback();
                return false;
            }

            // Sort rule
            $i_formulas = $this->sortRule($i_formulas);

            // Insert Formulas
            foreach ($i_formulas as $key => $formula) {
                $i_two = [
                    'code'         => $this->formulaRepo->generateCode('FORMULA'),
                    'rule'         => $formula['rule'],
                    'name'         => $formula['name'],
                    'value1'       => $formula['value1'],
                    'value2'       => $formula['value2'],
                    'index'        => ++$key,
                    'created_by'   => $this->user->id,
                    'updated_by'   => 0,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_date' => null,
                    'active'       => true,
                    'postage_id'   => $one->id,
                ];

                $two = $this->formulaRepo->create($i_two);
                if (!$two) {
                    DB::rollback();
                    return false;
                }
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public function updateOne($data)
    {
        $i_postage  = $data['postage'];
        $i_formulas = $data['formulas'];

        try {
            DB::beginTransaction();

            $one = $this->postageRepo->find($i_postage['id']);

            $i_one = [
                'unit_price'       => $i_postage['unit_price'],
                'delivery_percent' => $i_postage['delivery_percent'],
                'apply_date'       => $i_postage['apply_date'],
                'change_by_fuel'   => $i_postage['change_by_fuel'],
                'note'             => $i_postage['note'],
                'updated_by'       => $this->user->id,
                'updated_date'     => date('Y-m-d H:i:s'),
                'active'           => true,
                'customer_id'      => $i_postage['customer_id'],
                'unit_id'          => $i_postage['unit_id'],
                'fuel_id'          => $i_postage['fuel_id']
            ];

            $one = $this->postageRepo->update($one, $i_one);

            if (!$one) {
                DB::rollback();
                return false;
            }

            // Delete Formulas
            $this->formulaRepo->deleteByPostageId($one->id);

            // Sort rule
            $i_formulas = $this->sortRule($i_formulas);

            // Insert Formulas
            foreach ($i_formulas as $formula) {
                $i_two = [
                    'code'         => $this->formulaRepo->generateCode('FORMULA'),
                    'rule'         => $formula['rule'],
                    'name'         => $formula['name'],
                    'value1'       => $formula['value1'],
                    'value2'       => $formula['value2'],
                    'index'        => $formula['index'],
                    'created_by'   => $this->user->id,
                    'updated_by'   => 0,
                    'created_date' => date('Y-m-d H:i:s'),
                    'updated_date' => null,
                    'active'       => true,
                    'postage_id'   => $one->id,
                ];

                $two = $this->formulaRepo->create($i_two);
                if (!$two) {
                    DB::rollback();
                    return false;
                }
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public function deactivateOne($id)
    {
        try {
            DB::beginTransaction();

            $one = $this->postageRepo->deactivate($id);

            if (!$one) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public function deleteOne($id)
    {
        try {
            DB::beginTransaction();

            $one = $this->postageRepo->destroy($id);

            if (!$one) {
                DB::rollback();
                return false;
            }

            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollBack();
            return false;
        }
    }

    public function searchOne($filter)
    {
        $from_date = $filter['from_date'];
        $to_date   = $filter['to_date'];
        $range     = $filter['range'];

        $filtered = $this->skeleton;

        $filtered = $this->postageRepo->filterFromDateToDate($filtered, 'positions.created_at', $from_date, $to_date);

        $filtered = $this->postageRepo->filterRangeDate($filtered, 'positions.created_at', $range);

        return [
            'positions' => $filtered->get()
        ];
    }

    /** ===== VALIDATION ===== */
    public function validateInput($data)
    {
        if (!$this->validateEmpty($data))
            return ['status' => false, 'errors' => 'Dữ liệu không hợp lệ.'];

        $msgs = $this->validateLogic($data);
        return $msgs;
    }

    public function validateEmpty($data)
    {
        return true;
    }

    public function validateLogic($data)
    {
        $msg_error = [];

        $skip_id = isset($data['id']) ? [$data['id']] : [];

        return [
            'status' => count($msg_error) > 0 ? false : true,
            'errors' => $msg_error
        ];
    }

    /** ===== MY FUNCTION ===== */
    public function getReadByCustomerId()
    {
        $customer_id = Route::current()->parameter('customer_id');
        $one         = $this->readByCustomerId($customer_id);
        return response()->json($one, 200);
    }

    private function readByCustomerId($customer_id)
    {
        $postages = $this->postageRepo->readByCustomerId($customer_id);

        return [
            'postages' => $postages
        ];
    }

    private function sortRule($i_formulas) {
        return collect($i_formulas)->sortBy(function($formula, $key){
            return $formula['rule'];
        });
    }
}
