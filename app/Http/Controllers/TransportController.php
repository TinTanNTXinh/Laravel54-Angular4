<?php

namespace App\Http\Controllers;

use App\Common\DateTimeHelper;
use App\Common\DBHelper;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Route;
use DB;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Traits\UserHelper;
use App\Traits\Domain\FormulaHelper;
use App\Traits\Domain\PostageHelper;
use App\Traits\Domain\TransportHelper;
use App\Traits\Domain\CustomerHelper;
use App\Traits\Domain\TruckHelper;
use App\Traits\Domain\ProductHelper;
use App\Traits\Domain\VoucherHelper;
use App\Transport;
use App\TransportFormula;
use App\Voucher;
use App\TransportVoucher;
use App\Repositories\TransportRepositoryInterface;

class TransportController extends Controller implements ICrud, IValidate
{
    use UserHelper, FormulaHelper, PostageHelper
        , TransportHelper, CustomerHelper, TruckHelper, ProductHelper
        , VoucherHelper;

    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;

    protected $transportRepo;

    public function __construct(TransportRepositoryInterface $transportRepo)
    {
        $this->transportRepo = $transportRepo;

        $current_month   = DateTimeHelper::getFirstDayLastDay();
        $this->first_day = $current_month['first_day'];
        $this->last_day  = $current_month['last_day'];
        $this->today     = $current_month['today'];

        $jwt_data = $this->getCurrentUser();
        if ($jwt_data['status']) {
            $user_data = $this->getInfoCurrentUser($jwt_data['user']);
            if ($user_data['status'])
                $this->user = $user_data['user'];
        }

        $this->table_name = 'transport';
        $this->skeleton   = $this->transportRepo->allSkeleton();
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
        $transports = $this->skeleton->get();

        $customers = $this->readAllCustomer()['skeleton']->get();
        $trucks    = $this->readAllTruck()['skeleton']->get();
        $products  = $this->readAllProduct()['skeleton']->get();
        $vouchers  = $this->readAllVoucher()['skeleton']->get();

        return [
            'transports' => $transports,
            'customers'  => $customers,
            'trucks'     => $trucks,
            'products'   => $products,
            'vouchers'   => $vouchers,
            'first_day'  => $this->first_day,
            'last_day'   => $this->last_day,
            'today'      => $this->today
        ];
    }

    public function readOne($id)
    {
        $one = $this->transportRepo->oneSkeleton($id)->first();

        $transport_vouchers = TransportVoucher::whereActive(true)
            ->where('transport_id', $id)
            ->get();

        $transport_formulas = TransportFormula::whereActive(true)
            ->where('transport_id', $id)
            ->get();

        return [
            $this->table_name    => $one,
            'transport_vouchers' => $transport_vouchers,
            'transport_formulas' => $transport_formulas
        ];
    }

    public function createOne($data)
    {
        $transport          = $data['transport'];
        $formulas           = $data['formulas'];
        $transport_vouchers = $data['transport_vouchers'];

        try {
            DB::beginTransaction();

            $input = [
                'code'             => $this->transportRepo->generateCode('TRANSPORT'),
                'transport_date'   => DateTimeHelper::toStringDateTimeClientForDB($transport['transport_date']),
                'type1'            => $transport['type1'],
                'type2'            => '',
                'type3'            => '',
                'quantum_product'  => $transport['quantum_product'],
                'revenue'          => $transport['revenue'],
                'profit'           => 0,
                'receive'          => $transport['receive'],
                'delivery'         => $transport['delivery'],
                'carrying'         => $transport['carrying'],
                'parking'          => $transport['parking'],
                'fine'             => $transport['fine'],
                'phi_tang_bo'      => $transport['phi_tang_bo'],
                'add_score'        => $transport['add_score'],
                'delivery_real'    => $transport['delivery'],
                'carrying_real'    => $transport['carrying'],
                'parking_real'     => $transport['parking'],
                'fine_real'        => $transport['fine'],
                'phi_tang_bo_real' => $transport['phi_tang_bo'],
                'add_score_real'   => $transport['add_score'],

                'voucher_number'             => $transport['voucher_number'],
                'quantum_product_on_voucher' => $transport['quantum_product_on_voucher'],
                'receiver'                   => $transport['receiver'],

                'note'         => $transport['note'],
                'created_by'   => $this->user->id,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true,
                'truck_id'     => $transport['truck_id'],
                'product_id'   => $transport['product_id'],
                'customer_id'  => $transport['customer_id'],
                'postage_id'   => $transport['postage_id'],
                'fuel_id'      => $transport['fuel_id']
            ];

            $one = $this->transportRepo->create($input);

            if (!$one) {
                DB::rollback();
                return false;
            }

            # Insert VoucherTransport
            foreach ($transport_vouchers as $transport_voucher) {
                if ($transport_voucher['quantum'] <= 0) continue;

                $voucher_transport_new               = new TransportVoucher();
                $voucher_transport_new->transport_id = $one->id;
                $voucher_transport_new->voucher_id   = $transport_voucher['voucher_id'];
                $voucher_transport_new->quantum      = $transport_voucher['quantum'];
                $voucher_transport_new->created_by   = $one->created_by;
                $voucher_transport_new->updated_by   = 0;
                $voucher_transport_new->created_date = $one->created_date;
                $voucher_transport_new->updated_date = null;
                $voucher_transport_new->active       = true;

                if (!$voucher_transport_new->save()) {
                    DB::rollback();
                    return false;
                }
            }

            # Insert TransportFormula
            foreach ($formulas as $formula) {
                $transport_formula               = new TransportFormula();
                $transport_formula->rule         = $formula['rule'];
                $transport_formula->name         = $formula['name'];
                $transport_formula->value1       = $formula['value1'];
                $transport_formula->value2       = $formula['value2'];
                $transport_formula->active       = true;
                $transport_formula->transport_id = $one->id;

                if (!$transport_formula->save()) {
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
        $transport          = $data['transport'];
        $formulas           = $data['formulas'];
        $transport_vouchers = $data['transport_vouchers'];
        try {
            DB::beginTransaction();

            $input = [
                'transport_date'   => DateTimeHelper::toStringDateTimeClientForDB($transport['transport_date']),
                'type1'            => $transport['type1'],
                'type2'            => '',
                'type3'            => '',
                'quantum_product'  => $transport['quantum_product'],
                'revenue'          => $transport['revenue'],
                'profit'           => 0,
                'receive'          => $transport['receive'],
                'delivery'         => $transport['delivery'],
                'carrying'         => $transport['carrying'],
                'parking'          => $transport['parking'],
                'fine'             => $transport['fine'],
                'phi_tang_bo'      => $transport['phi_tang_bo'],
                'add_score'        => $transport['add_score'],
                'delivery_real'    => $transport['delivery'],
                'carrying_real'    => $transport['carrying'],
                'parking_real'     => $transport['parking'],
                'fine_real'        => $transport['fine'],
                'phi_tang_bo_real' => $transport['phi_tang_bo'],
                'add_score_real'   => $transport['add_score'],

                'voucher_number'             => $transport['voucher_number'],
                'quantum_product_on_voucher' => $transport['quantum_product_on_voucher'],
                'receiver'                   => $transport['receiver'],

                'note'         => $transport['note'],
                'updated_by'   => $this->user->id,
                'updated_date' => date('Y-m-d'),
                'active'       => true,
                'truck_id'     => $transport['truck_id'],
                'product_id'   => $transport['product_id'],
                'customer_id'  => $transport['customer_id'],
                'postage_id'   => $transport['postage_id'],
                'fuel_id'      => $transport['fuel_id']
            ];

            $one = $this->transportRepo->find($transport['id']);

            $one = $this->transportRepo->update($one, $input);
            if (!$one) {
                DB::rollBack();
                return false;
            }

            # Delete TransportVoucher
            TransportVoucher::whereActive(true)
                ->where('transport_id', $one->id)
                ->delete();

            # Insert TransportVoucher
            foreach ($transport_vouchers as $transport_voucher) {
                if ($transport_voucher['quantum'] <= 0) continue;

                $voucher_transport_new               = new TransportVoucher();
                $voucher_transport_new->transport_id = $one->id;
                $voucher_transport_new->voucher_id   = $transport_voucher['voucher_id'];
                $voucher_transport_new->quantum      = $transport_voucher['quantum'];
                $voucher_transport_new->created_by   = $one->created_by;
                $voucher_transport_new->updated_by   = 0;
                $voucher_transport_new->created_date = $one->created_date;
                $voucher_transport_new->updated_date = null;
                $voucher_transport_new->active       = true;

                if (!$voucher_transport_new->save()) {
                    DB::rollback();
                    return false;
                }
            }

            # Delete TransportFormula
            TransportFormula::whereActive(true)
                ->where('transport_id', $one->id)
                ->delete();

            # Insert TransportFormula
            foreach ($formulas as $formula) {
                $transport_formula               = new TransportFormula();
                $transport_formula->rule         = $formula['rule'];
                $transport_formula->name         = $formula['name'];
                $transport_formula->value1       = $formula['value1'];
                $transport_formula->value2       = $formula['value2'];
                $transport_formula->active       = true;
                $transport_formula->transport_id = $one->id;

                if (!$transport_formula->save()) {
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

            $one = $this->transportRepo->deactivate($id) ? true : false;

            if (!$one) {
                DB::rollBack();
                return false;
            }

            # Deactivate TransportVoucher
            $transport_vouchers_delete = TransportVoucher::whereActive(true)
                ->where('transport_id', $id)
                ->get();

            $transport_vouchers_delete->each(function ($item) {
                $item->active = false;
                $item->update();
            });

            # Deactivate TransportFormula
            $transport_formulas_delete = TransportFormula::whereActive(true)
                ->where('transport_id', $id)
                ->get();

            $transport_formulas_delete->each(function ($item) {
                $item->active = false;
                $item->update();
            });

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

            $one = $this->transportRepo->destroy($id) ? true : false;
            if (!$one) {
                DB::rollBack();
                return false;
            }

            # Delete TransportVoucher
            $transport_vouchers_delete = TransportVoucher::whereActive(true)
                ->where('transport_id', $id)
                ->get();

            $transport_vouchers_delete->each(function ($item) {
                $item->delete();
            });

            # Delete TransportFormula
            $transport_formulas_delete = TransportFormula::whereActive(true)
                ->where('transport_id', $id)
                ->get();

            $transport_formulas_delete->each(function ($item) {
                $item->delete();
            });

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

        $transports = $this->skeleton;

        $transports = $this->transportRepo->filterFromDateToDate($transports, 'transports.created_date', $from_date, $to_date);

        $transports = $this->transportRepo->filterRangeDate($transports, 'transports.created_date', $range);

        return [
            'transports' => $transports->get()
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
    public function getReadFormulas()
    {
        $filter    = (array)json_decode($_GET['query']);
        $arr_datas = $this->readFormulas($filter);
        return response()->json($arr_datas, 200);
    }

    public function readFormulas($data)
    {
        $customer_id    = $data['customer_id'];
        $transport_date = DateTimeHelper::toStringDateTimeClientForDB($data['transport_date']);

        $formulas = $this->findFormulas($customer_id, $transport_date);

        return $formulas;
    }

    public function getReadPostage()
    {
        $filter    = (array)json_decode($_GET['query']);
        $arr_datas = $this->readPostage($filter);
        return response()->json($arr_datas, 200);
    }

    public function readPostage($data)
    {
        $i_customer_id    = $data['customer_id'];
        $i_transport_date = DateTimeHelper::toStringDateTimeClientForDB($data['transport_date']);
        $i_formulas       = $data['formulas'];

        $postage = $this->findPostage($i_formulas, $i_customer_id, $i_transport_date);

        return $postage;
    }
}