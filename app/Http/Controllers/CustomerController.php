<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\CustomerRepositoryInterface;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Traits\UserHelper;
use App\Common\DateTimeHelper;
use Route;

class CustomerController extends Controller implements ICrud, IValidate
{
    use UserHelper;

    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;

    protected $customerRepo;

    public function __construct(CustomerRepositoryInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;

        $jwt_data = $this->getCurrentUser();
        if ($jwt_data['status']) {
            $user_data = $this->getInfoCurrentUser($jwt_data['user']);
            if ($user_data['status'])
                $this->user = $user_data['user'];
        }

        $current_month   = DateTimeHelper::getFirstDayLastDay();
        $this->first_day = $current_month['first_day'];
        $this->last_day  = $current_month['last_day'];
        $this->today     = $current_month['today'];

        $this->table_name = 'customer';
        $this->skeleton   = $this->customerRepo->allActive();
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
            'customers' => $all
        ];
    }

    public function readOne($id)
    {
        $one = $this->customerRepo->filterColumn($this->skeleton, 'customers.id', $id)->first();

        return [
            $this->table_name => $one
        ];
    }

    public function createOne($data)
    {
        $one = [
            'code'        => $this->customerRepo->generateCode('CUSTOMER'),
            'name'        => $data['name'],
            'description' => $data['description'],
            'active'      => true
        ];

        return $this->customerRepo->create($one) ? true : false;
    }

    public function updateOne($data)
    {
        $one = $this->customerRepo->find($data['id']);

        $input = [
            'name'        => $data['name'],
            'description' => $data['description']
        ];

        return $this->customerRepo->update($one, $input) ? true : false;
    }

    public function deactivateOne($id)
    {
        return $this->customerRepo->deactivate($id) ? true : false;
    }

    public function deleteOne($id)
    {
        return $this->customerRepo->destroy($id) ? true : false;
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
