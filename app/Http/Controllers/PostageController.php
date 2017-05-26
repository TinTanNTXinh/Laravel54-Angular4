<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PostageRepositoryInterface;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Traits\UserHelper;
use App\Common\DateTimeHelper;
use Route;

class PostageController extends Controller implements ICrud, IValidate
{
    use UserHelper;

    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;
    private $dateTimeHelper;

    protected $postageRepo = '';

    public function __construct(PostageRepositoryInterface $postageRepo)
    {
        $this->postageRepo = $postageRepo;

        $jwt_data = $this->getCurrentUser();
        if ($jwt_data['status']) {
            $user_data = $this->getInfoCurrentUser($jwt_data['user']);
            if ($user_data['status'])
                $this->user = $user_data['user'];
        }

        $this->dateTimeHelper = new DateTimeHelper();
        $current_month        = $this->dateTimeHelper->getFirstDayLastDay();
        $this->first_day      = $current_month['first_day'];
        $this->last_day       = $current_month['last_day'];
        $this->today          = $current_month['today'];

        $this->table_name = 'postage';
        $this->skeleton   = $this->postageRepo->allActive();
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

        return [
            'postages' => $all
        ];
    }

    public function readOne($id)
    {
        $one = $this->postageRepo->filterColumn($this->skeleton, 'postages.id', $id)->first();

        return [
            'postage' => $one
        ];
    }

    public function createOne($data)
    {
        $one = [
            'code'             => $this->postageRepo->generateCode('POSTAGE'),
            'unit_price'       => $data['unit_price'],
            'delivery_percent' => $data['delivery_percent'],
            'apply_date'       => $data['apply_date'],
            'change_by_fuel'   => false,
            'note'             => $data['note'],
            'created_by'       => $this->user->id,
            'updated_by'       => 0,
            'created_date'     => date('Y-m-d H:i:s'),
            'updated_date'     => null,
            'active'           => true,
            'customer_id'      => $data['customer_id'],
            'unit_id'          => $data['unit_id'],
            'fuel_id'          => $data['fuel_id']
        ];

        return $this->postageRepo->create($one) ? true : false;
    }

    public function updateOne($data)
    {
        $one = $this->postageRepo->find($data['id']);

        $input = [
            'unit_price'       => $data['unit_price'],
            'delivery_percent' => $data['delivery_percent'],
            'apply_date'       => $data['apply_date'],
            'change_by_fuel'   => $data['change_by_fuel'],
            'note'             => $data['note'],
            'updated_by'       => $this->user->id,
            'updated_date'     => date('Y-m-d H:i:s'),
            'active'           => true,
            'customer_id'      => $data['customer_id'],
            'unit_id'          => $data['unit_id'],
            'fuel_id'          => $data['fuel_id']
        ];

        return $this->postageRepo->update($one, $input) ? true : false;
    }

    public function deactivateOne($id)
    {
        return $this->postageRepo->deactivate($id) ? true : false;
    }

    public function deleteOne($id)
    {
        return $this->postageRepo->destroy($id) ? true : false;
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
    private function readByCustomer($customer_id)
    {
        $postages = $this->postageRepo->filterColumn($this->skeleton, 'customer_id', $customer_id);
        return [
            'postages' => $postages
        ];
    }
}
