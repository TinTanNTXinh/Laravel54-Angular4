<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\PositionRepositoryInterface;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\GroupRoleRepositoryInterface;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Common\AuthHelper;
use App\Common\DateTimeHelper;
use Route;

class UserController extends Controller implements ICrud, IValidate
{
    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;

    protected $userRepo, $positionRepo, $roleRepo, $groupRoleRepo;

    public function __construct(UserRepositoryInterface $userRepo
        , PositionRepositoryInterface $positionRepo
        , RoleRepositoryInterface $roleRepo
        , GroupRoleRepositoryInterface $groupRoleRepo)
    {
        $this->userRepo      = $userRepo;
        $this->positionRepo  = $positionRepo;
        $this->roleRepo      = $roleRepo;
        $this->groupRoleRepo = $groupRoleRepo;

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

        $this->table_name = 'user';
        $this->skeleton   = $this->userRepo->allSkeleton();
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

        $positions   = $this->positionRepo->allActive();
        $roles       = $this->roleRepo->allActive();
        $group_roles = $this->groupRoleRepo->allActive();

        return [
            'users'       => $all,
            'positions'   => $positions,
            'roles'       => $roles,
            'group_roles' => $group_roles
        ];
    }

    public function readOne($id)
    {
        $one = $this->userRepo->oneSkeleton($id)->first();

        return [
            $this->table_name => $one
        ];
    }

    public function createOne($data)
    {
        $input = [
            'code'         => $this->userRepo->generateCode('USER'),
            'fullname'     => $data['fullname'],
            'username'     => $data['username'],
            'password'     => $data['password'],
            'address'      => $data['address'],
            'phone'        => $data['phone'],
            'birthday'     => DateTimeHelper::toStringDateTimeClientForDB($data['birthday']),
            'sex'          => $data['sex'],
            'email'        => $data['email'],
            'note'         => $data['note'],
            'created_by'   => $this->user->id,
            'updated_by'   => 0,
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => null,
            'active'       => true
        ];

        return $this->userRepo->create($input) ? true : false;
    }

    public function updateOne($data)
    {
        $one = $this->userRepo->find($data['id']);

        $input = [
            'fullname'     => $data['fullname'],
            'username'     => $data['username'],
            'password'     => $data['password'],
            'address'      => $data['address'],
            'phone'        => $data['phone'],
            'birthday'     => DateTimeHelper::toStringDateTimeClientForDB($data['birthday']),
            'sex'          => $data['sex'],
            'email'        => $data['email'],
            'note'         => $data['note'],
            'updated_by'   => $this->user->id,
            'updated_date' => date('Y-m-d H:i:s'),
            'active'       => true
        ];

        return $this->userRepo->update($one, $input) ? true : false;
    }

    public function deactivateOne($id)
    {
        return $this->userRepo->deactivate($id) ? true : false;
    }

    public function deleteOne($id)
    {
        return $this->userRepo->destroy($id) ? true : false;
    }

    public function searchOne($filter)
    {
        $from_date = $filter['from_date'];
        $to_date   = $filter['to_date'];
        $range     = $filter['range'];

        $filtered = $this->skeleton;

        $filtered = $this->userRepo->filterFromDateToDate($filtered, 'users.created_at', $from_date, $to_date);

        $filtered = $this->userRepo->filterRangeDate($filtered, 'users.created_at', $range);

        return [
            'users' => $filtered->get()
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
