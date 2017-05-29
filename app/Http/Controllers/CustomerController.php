<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\CustomerTypeRepositoryInterface;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Common\DateTimeHelper;
use App\Common\AuthHelper;
use Route;
use DB;
use League\Flysystem\Exception;

class CustomerController extends Controller implements ICrud, IValidate
{
    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;

    protected $customerRepo, $customerTypeRepo;

    public function __construct(CustomerRepositoryInterface $customerRepo
        , CustomerTypeRepositoryInterface $customerTypeRepo)
    {
        $this->customerRepo     = $customerRepo;
        $this->customerTypeRepo = $customerTypeRepo;

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

        $this->table_name = 'customer';
        $this->skeleton   = $this->customerRepo->allSkeleton();
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

        $customer_types = $this->customerTypeRepo->allActive();

        return [
            'customers'      => $all,
            'customer_types' => $customer_types
        ];
    }

    public function readOne($id)
    {
        $one = $this->customerRepo->oneSkeleton($id)->first();

        return [
            $this->table_name => $one
        ];
    }

    public function createOne($data)
    {
        try {
            DB::beginTransaction();

            $i_one = [
                'code'             => $this->customerRepo->generateCode('CUSTOMER'),
                'tax_code'         => $data['tax_code'],
                'fullname'         => $data['fullname'],
                'address'          => $data['address'],
                'phone'            => $data['phone'],
                'email'            => $data['email'],
                'limit_oil'        => $data['limit_oil'],
                'oil_per_postage'  => $data['oil_per_postage'],
                'finish_date'      => DateTimeHelper::toStringDateTimeClientForDB($data['finish_date']),
                'note'             => $data['note'],
                'created_by'       => $this->user->id,
                'updated_by'       => 0,
                'created_date'     => date('Y-m-d H:i:s'),
                'updated_date'     => null,
                'active'           => true,
                'customer_type_id' => $data['customer_type_id']
            ];

            $one = $this->customerRepo->create($i_one);

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

    public function updateOne($data)
    {
        try {
            DB::beginTransaction();

            $one = $this->customerRepo->find($data['id']);

            $i_one = [
                'tax_code'         => $data['tax_code'],
                'fullname'         => $data['fullname'],
                'address'          => $data['address'],
                'phone'            => $data['phone'],
                'email'            => $data['email'],
                'limit_oil'        => $data['limit_oil'],
                'oil_per_postage'  => $data['oil_per_postage'],
                'finish_date'      => DateTimeHelper::toStringDateTimeClientForDB($data['finish_date']),
                'note'             => $data['note'],
                'updated_by'       => $this->user->id,
                'updated_date'     => date('Y-m-d H:i:s'),
                'active'           => true,
                'customer_type_id' => $data['customer_type_id']
            ];

            $one = $this->customerRepo->update($one, $i_one);

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

    public function deactivateOne($id)
    {
        try {
            DB::beginTransaction();

            $one = $this->customerRepo->deactivate($id);

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

            $one = $this->customerRepo->destroy($id);

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

        $filtered = $this->customerRepo->filterFromDateToDate($filtered, 'customers.created_at', $from_date, $to_date);

        $filtered = $this->customerRepo->filterRangeDate($filtered, 'customers.created_at', $range);

        return [
            'customers' => $filtered->get()
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
}
