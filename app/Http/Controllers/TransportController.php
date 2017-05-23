<?php

namespace App\Http\Controllers;

use App\TransportFormula;
use App\Voucher;
use App\TransportVoucher;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Route;
use DB;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Traits\UserHelper;
use App\Traits\DBHelper;
use App\Traits\Domain\FormulaHelper;
use App\Traits\Domain\PostageHelper;
use App\Traits\Domain\TransportHelper;
use App\Traits\Domain\CustomerHelper;
use App\Traits\Domain\TruckHelper;
use App\Traits\Domain\ProductHelper;
use App\Transport;

class TransportController extends Controller implements ICrud, IValidate
{
    use UserHelper, DBHelper, FormulaHelper, PostageHelper
        , TransportHelper, CustomerHelper, TruckHelper, ProductHelper;

    private $first_day, $last_day, $today;
    private $user;
    private $format_date, $format_time;
    private $table_name;
    private $skeleton;

    public function __construct()
    {
        $format_date_time  = $this->getFormatDateTime();
        $this->format_date = $format_date_time['date'];
        $this->format_time = $format_date_time['time'];

        $current_month   = $this->getCurrentMonth();
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
        $this->skeleton   = $this->readAllTransport()['skeleton'];
    }

    /** API METHOD */
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

    /** LOGIC METHOD */
    public function readAll()
    {
        $transports = $this->skeleton->get();

        $customers = $this->readAllCustomer()['skeleton']->get();
        $trucks    = $this->readAllTruck()['skeleton']->get();
        $products  = $this->readAllProduct()['skeleton']->get();

        return [
            'transports' => $transports,
            'customers'  => $customers,
            'trucks'     => $trucks,
            'products'   => $products,
            'first_day'  => $this->first_day,
            'last_day'   => $this->last_day,
            'today'      => $this->today
        ];
    }

    public function readOne($id)
    {
        $one = Transport::find($id);
        return [$this->table_name => $one];
    }

    public function createOne($data)
    {
        $transport          = $data['transport'];
        $formulas           = $data['formulas'];
        $transport_vouchers = $data['transport_vouchers'];
        try {
            DB::beginTransaction();
            $one                   = new Transport();
            $one->code             = $this->generateCode(Transport::class, 'TRANSPORT');
            $one->transport_date   = $this->toStringDateTimeClientForDB($transport['transport_date']);
            $one->type1            = 'NORMAL';
            $one->type2            = '';
            $one->type3            = '';
            $one->quantum_product  = $transport['quantum_product'];
            $one->revenue          = $transport['revenue'];
            $one->profit           = 0;
            $one->receive          = $transport['receive'];
            $one->delivery         = $transport['delivery'];
            $one->carrying         = $transport['carrying'];
            $one->parking          = $transport['parking'];
            $one->fine             = $transport['fine'];
            $one->phi_tang_bo      = $transport['phi_tang_bo'];
            $one->add_score        = $transport['add_score'];
            $one->delivery_real    = $transport['delivery_real'];
            $one->carrying_real    = $transport['carrying_real'];
            $one->parking_real     = $transport['parking_real'];
            $one->fine_real        = $transport['fine_real'];
            $one->phi_tang_bo_real = $transport['phi_tang_bo_real'];
            $one->add_score_real   = $transport['add_score_real'];

            $one->voucher_number             = $transport['voucher_number'];
            $one->quantum_product_on_voucher = $transport['quantum_product_on_voucher'];
            $one->receiver                   = $transport['receiver'];

            $one->note         = $transport['note'];
            $one->created_by   = $this->user->id;
            $one->updated_by   = 0;
            $one->created_date = date('Y-m-d H:i:s');
            $one->updated_date = null;
            $one->active       = true;
            $one->truck_id     = $transport['truck_id'];
            $one->customer_id  = $transport['customer_id'];
            $one->postage_id   = $transport['postage_id'];
            $one->fuel_id      = $transport['fuel_id'];

            if (!$one->save()) {
                DB::rollback();
                return false;
            }

            # Insert VoucherTransport
            foreach ($transport_vouchers as $transport_voucher) {
                $voucher_transport_new = new TransportVoucher();
                $voucher_transport_new->transport_id = $one->id;
                $voucher_transport_new->voucher_id = $transport_voucher['voucher_id'];
                $voucher_transport_new->quantum = $transport_voucher['quantum'];
                $voucher_transport_new->created_by = $one->created_by;
                $voucher_transport_new->updated_by = 0;
                $voucher_transport_new->created_date = $one->created_date;
                $voucher_transport_new->updated_date = null;
                $voucher_transport_new->active       = true;

                if(!$voucher_transport_new->save()){
                    DB::rollback();
                    return false;
                }
            }

            # Insert TransportFormula

            foreach ($formulas as $formula) {
                $transport_formula = new TransportFormula();
                $transport_formula->rule = $formula['rule'];
                $transport_formula->name = $formula['name'];
                $transport_formula->value1 = $formula['value1'];
                $transport_formula->value2 = $formula['value2'];
                $transport_formula->active = true;
                $transport_formula->transport_id = $one->id;

                if(!$transport_formula->save()){
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
        try {
            DB::beginTransaction();
            $one       = Transport::find($data['id']);
            $one->code = $data['code'];

            $one->updated_date = date('Y-m-d H:i:s');
            $one->active       = true;
            if (!$one->update()) {
                DB::rollBack();
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
            $one         = Transport::find($id);
            $one->active = false;
            if (!$one->update()) {
                DB::rollBack();
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
            $one = Transport::find($id);
            if (!$one->delete()) {
                DB::rollBack();
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

        $transports = $this->skeleton;

        $transports = $this->searchFromDateToDate($transports, 'transports.created_date', $from_date, $to_date);

        $transports = $this->searchRangeDate($transports, 'transports.created_date', $range);

        return [
            'transports' => $transports->get()
        ];
    }

    /** VALIDATION */
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

    /** MY FUNCTION */
    public function getReadFormulas()
    {
        $filter    = (array)json_decode($_GET['query']);
        $arr_datas = $this->readFormulas($filter);
        return response()->json($arr_datas, 200);
    }

    public function readFormulas($data)
    {
        $customer_id    = $data['customer_id'];
        $transport_date = $this->toStringDateTimeClientForDB($data['transport_date']);

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
        $i_transport_date = $this->toStringDateTimeClientForDB($data['transport_date']);
        $i_formulas       = $data['formulas'];

        $postage = $this->findPostage($i_formulas, $i_customer_id, $i_transport_date);

        return $postage;
    }
}