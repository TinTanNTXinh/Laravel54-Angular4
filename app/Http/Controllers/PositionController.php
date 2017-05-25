<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

use App\Repositories\PositionRepositoryInterface;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Traits\UserHelper;
use App\Traits\DBHelper;
use Route;
use DB;

class PositionController extends Controller implements ICrud, IValidate
{
    use UserHelper, DBHelper;

    private $first_day, $last_day, $today;
    private $format_date, $format_time;
    private $user;
    private $table_name;
    private $skeleton;

    protected $positionRepository  = '';
    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;

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

        $this->table_name = 'position';
        $this->skeleton   = $this->positionRepository->allActive();
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
            'positions' => $all
        ];
    }

    public function readOne($id)
    {
        $one = $this->skeleton->where('positions.id', $id)->first();

        return [
            'position' => $one
        ];
    }

    public function createOne($data)
    {
        $one = [
            'code' => $this->generateCode(Position::class, 'POSITION'),
            'name' => $data['name'],
            'description' => $data['description'],
            'active' => true
        ];

        return $this->positionRepository->create($one) ? true : false;
    }

    public function updateOne($data)
    {
        $one = $this->positionRepository->find($data['id']);

        $input = [
            'name' => $data['name'],
            'description' => $data['description']
        ];

        return $this->positionRepository->update($one, $input) ? true : false;
    }

    public function deactivateOne($id)
    {
        return $this->positionRepository->deactivate($id) ? true : false;
    }

    public function deleteOne($id)
    {
        return $this->positionRepository->destroy($id) ? true : false;
    }

    public function searchOne($filter)
    {
        $from_date = $filter['from_date'];
        $to_date   = $filter['to_date'];
        $range     = $filter['range'];

        $filtered = $this->skeleton;

        $filtered = $this->searchFromDateToDate($filtered, 'positions.created_at', $from_date, $to_date);

        $filtered = $this->searchRangeDate($filtered, 'positions.created_at', $range);

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
}
