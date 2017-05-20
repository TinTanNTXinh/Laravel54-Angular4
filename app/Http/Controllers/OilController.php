<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Formula;
use App\Fuel;
use App\FuelCustomer;
use App\Postage;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Route;
use DB;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Traits\UserHelper;
use App\Traits\DBHelper;
use App\Traits\Domain\FuelHelper;

class OilController extends Controller implements ICrud, IValidate
{
    use UserHelper, DBHelper, FuelHelper;

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
        $this->skeleton   = Fuel::where('fuels.active', true)
            ->leftJoin('users as creators', 'creators.id', '=', 'fuels.created_by')
            ->leftJoin('users as updators', 'updators.id', '=', 'fuels.updated_by')
            ->orderBy('fuels.apply_date', 'desc')
            ->select('fuels.*',
                'creators.fullname as creator_fullname',
                'updators.fullname as updator_fullname'
            );
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

        return [
            'transports' => $transports,
            'first_day'  => $this->first_day,
            'last_day'   => $this->last_day,
            'today'      => $this->today
        ];
    }

    public function readOne($id)
    {
        $one = Fuel::find($id);
        return [$this->table_name => $one];
    }

    public function createOne($data)
    {
        try {
            DB::beginTransaction();
            $one               = new Fuel();
            $one->code         = $this->generateCode(Fuel::class, 'FUEL');
            $one->price        = $data['price'];
            $one->type         = $data['type'];
            $one->apply_date   = $data['apply_date'];
            $one->note         = $data['note'];
            $one->created_by   = $this->user->id;
            $one->updated_by   = 0;
            $one->created_date = date('Y-m-d H:i:s');
            $one->updated_date = null;
            $one->active       = true;
            if (!$one->save()) {
                DB::rollback();
                return false;
            }

            $fuel_customers = FuelCustomer::whereActive(true)->get();
            foreach($fuel_customers as $fuel_customer) {
                # Find Customer
                $customer = Customer::find($fuel_customer->customer_id);

                # Find current Fuel of Customer
                $current_oil_of_customer = Fuel::find($fuel_customer->fuel_id);

                # Compute change_percent
                $change_percent = ($one->price - $current_oil_of_customer->price) / ($current_oil_of_customer->price) * 100;

                # Nếu KH không vượt qua limit_oil -> bỏ qua
                if ($customer->limit_oil > abs($change_percent)) continue;

                $postages = Postage::whereActive(true)
                    ->where('customer_id', $customer->id)
                    ->get();
                # Nếu KH chưa có cước phí -> bỏ qua
                if($postages->count() == 0) continue;

                $check_null = $postages->where('apply_date', '=', null)->get();
                if($check_null->count() > 0)

                foreach($postages as $postage) {
                    $formulas = Formula::whereActive(true)
                        ->where('postage_id', $postage->id)
                        ->get();

                    # Nếu trong công thức có Giá dầu -> bỏ qua
                    $check_oil = $formulas->when('rule', 'O')->get();
                    if(count($check_oil) > 0) continue;

                    if($postage->apply_date == null) {
                        DB::rollback();
                        return false;
                    }

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
            $one       = Fuel::find($data['id']);
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
            $one         = Fuel::find($id);
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
            $one = Fuel::find($id);
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

        $fuels = $this->skeleton;

        $fuels = $this->searchFromDateToDate($fuels, 'fuels.created_date', $from_date, $to_date);

        $fuels = $this->searchRangeDate($fuels, 'fuels.created_date', $range);

        return [
            'fuels' => $fuels->get()
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

        if ($this->checkExistData(Fuel::class, 'code', $data['code'], $skip_id))
            array_push($msg_error, 'Mã nhiên liệu đã tồn tại.');

        $oil = $this->currentFuel('oil')['oil'];
        $result = $this->compareDateTime($data['apply_date'], '', $oil->apply_date, 'Y-m-d H:i:s');
        switch ($result) {
            case -1:
            case 0:
            array_push($msg_error, 'Ngày áp dụng không được nhỏ hơn hoặc bằng ngày áp dụng của giá dầu hiện tại.');
                break;
            case 1:
                break;
            default: break;
        }

        return [
            'status' => count($msg_error) > 0 ? false : true,
            'errors' => $msg_error
        ];
    }

    /** MY FUNCTION **/

}
