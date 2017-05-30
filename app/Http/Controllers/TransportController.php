<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Route;
use DB;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Repositories\TransportRepositoryInterface;
use App\Repositories\FormulaRepositoryInterface;
use App\Repositories\PostageRepositoryInterface;
use App\Repositories\CustomerRepositoryInterface;
use App\Repositories\TruckRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\VoucherRepositoryInterface;
use App\Repositories\TransportFormulaRepositoryInterface;
use App\Repositories\TransportVoucherRepositoryInterface;
use App\Common\DateTimeHelper;
use App\Common\AuthHelper;

class TransportController extends Controller implements ICrud, IValidate
{
    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;

    protected $transportRepo, $formulaRepo, $postageRepo
        , $customerRepo, $truckRepo, $productRepo, $voucherRepo
        , $transportFormulaRepo, $transportVoucherRepo;

    public function __construct(TransportRepositoryInterface $transportRepo
        , FormulaRepositoryInterface $formulaRepo
        , PostageRepositoryInterface $postageRepo
        , CustomerRepositoryInterface $customerRepo
        , TruckRepositoryInterface $truckRepo
        , ProductRepositoryInterface $productRepo
        , VoucherRepositoryInterface $voucherRepo
        , TransportFormulaRepositoryInterface $transportFormulaRepo
        , TransportVoucherRepositoryInterface $transportVoucherRepo)
    {
        $this->transportRepo = $transportRepo;
        $this->formulaRepo = $formulaRepo;
        $this->postageRepo = $postageRepo;
        $this->customerRepo = $customerRepo;
        $this->truckRepo = $truckRepo;
        $this->productRepo = $productRepo;
        $this->voucherRepo = $voucherRepo;
        $this->transportFormulaRepo = $transportFormulaRepo;
        $this->transportVoucherRepo = $transportVoucherRepo;

        $current_month   = DateTimeHelper::getFirstDayLastDay();
        $this->first_day = $current_month['first_day'];
        $this->last_day  = $current_month['last_day'];
        $this->today     = $current_month['today'];

        $jwt_data = AuthHelper::getCurrentUser();
        if ($jwt_data['status']) {
            $user_data = AuthHelper::getInfoCurrentUser($jwt_data['user']);
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

        $customers = $this->customerRepo->allActive();
        $trucks    = $this->truckRepo->allActive();
        $products  = $this->productRepo->allActive();
        $vouchers  = $this->voucherRepo->allActive();

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

        $transport_vouchers = $this->transportVoucherRepo->readByTransportId($id);

        $transport_formulas = $this->transportFormulaRepo->readByTransportId($id);

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

            # Insert TransportVoucher
            foreach ($transport_vouchers as $transport_voucher) {
                if ($transport_voucher['quantum'] <= 0) continue;

                $input = [
                    'voucher_id'   => $transport_voucher['voucher_id'],
                    'transport_id' => $one->id,
                    'quantum'      => $transport_voucher['quantum'],
                    'created_by'   => $one->created_by,
                    'updated_by'   => 0,
                    'created_date' => $one->created_date,
                    'updated_date' => null,
                    'active'       => true
                ];

                $voucher_transport_new = $this->transportVoucherRepo->create($input);

                if (!$voucher_transport_new) {
                    DB::rollback();
                    return false;
                }
            }

            # Insert TransportFormula
            foreach ($formulas as $formula) {

                $input = [
                    'rule'         => $formula['rule'],
                    'name'         => $formula['name'],
                    'value1'       => $formula['value1'],
                    'value2'       => $formula['value2'],
                    'active'       => true,
                    'transport_id' => $one->id
                ];

                $transport_formula_new = $this->transportFormulaRepo->create($input);

                if (!$transport_formula_new) {
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
            $this->transportVoucherRepo->deleteByTransportId($one->id);


            # Insert TransportVoucher
            foreach ($transport_vouchers as $transport_voucher) {
                if ($transport_voucher['quantum'] <= 0) continue;

                $input = [
                    'voucher_id'   => $transport_voucher['voucher_id'],
                    'transport_id' => $one->id,
                    'quantum'      => $transport_voucher['quantum'],
                    'created_by'   => $one->created_by,
                    'updated_by'   => 0,
                    'created_date' => $one->created_date,
                    'updated_date' => null,
                    'active'       => true
                ];

                $voucher_transport_new = $this->transportVoucherRepo->create($input);

                if (!$voucher_transport_new) {
                    DB::rollback();
                    return false;
                }
            }

            # Delete TransportFormula
            $this->transportFormulaRepo->deleteByTransportId($one->id);

            # Insert TransportFormula
            foreach ($formulas as $formula) {
                $input = [
                    'rule'         => $formula['rule'],
                    'name'         => $formula['name'],
                    'value1'       => $formula['value1'],
                    'value2'       => $formula['value2'],
                    'active'       => true,
                    'transport_id' => $one->id
                ];

                $transport_formula_new = $this->transportFormulaRepo->create($input);

                if (!$transport_formula_new) {
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
            $this->transportVoucherRepo->deactivateByTransportId($id);

            # Deactivate TransportFormula
            $this->transportFormulaRepo->deactivateByTransportId($id);

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
            $this->transportVoucherRepo->deleteByTransportId($id);

            # Delete TransportFormula
            $this->transportFormulaRepo->deleteByTransportId($id);

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

        $postage = $this->postageRepo->findByCustomerIdAndTransportDate($customer_id, $transport_date);

        if(!$postage) return ['formulas' => []];

        $formulas = $this->formulaRepo->readByPostageId($postage->id);

        return ['formulas' => $formulas];
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

        $postage_id = $this->formulaRepo->findPostageIdByFormulas($i_formulas, $i_customer_id, $i_transport_date);
        $postage = $this->postageRepo->oneSkeleton($postage_id)->first();

        return ['postage' => $postage];
    }
}