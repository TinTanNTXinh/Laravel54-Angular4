<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\PositionRepositoryInterface;
use App\Repositories\RoleRepositoryInterface;
use App\Repositories\GroupRoleRepositoryInterface;
use App\Repositories\UserRoleRepositoryInterface;
use App\Repositories\UserPositionRepositoryInterface;
use App\Repositories\FieldRepositoryInterface;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;
use App\Common\AuthHelper;
use App\Common\DateTimeHelper;
use Route;
use DB;
use League\Flysystem\Exception;

class UserController extends Controller implements ICrud, IValidate
{
    private $first_day, $last_day, $today;
    private $user;
    private $table_name;
    private $skeleton;

    protected $userRepo, $positionRepo, $roleRepo, $groupRoleRepo
    , $userRoleRepo, $userPositionRepo, $fieldRepo;

    public function __construct(UserRepositoryInterface $userRepo
        , PositionRepositoryInterface $positionRepo
        , RoleRepositoryInterface $roleRepo
        , GroupRoleRepositoryInterface $groupRoleRepo
        , UserRoleRepositoryInterface $userRoleRepo
        , UserPositionRepositoryInterface $userPositionRepo
        , FieldRepositoryInterface $fieldRepo)
    {
        $this->userRepo         = $userRepo;
        $this->positionRepo     = $positionRepo;
        $this->roleRepo         = $roleRepo;
        $this->groupRoleRepo    = $groupRoleRepo;
        $this->userRoleRepo     = $userRoleRepo;
        $this->userPositionRepo = $userPositionRepo;
        $this->fieldRepo        = $fieldRepo;

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

        $fake_pwd = substr(config('app.key'), 10);

        return [
            'users'       => $all,
            'positions'   => $positions,
            'roles'       => $roles,
            'group_roles' => $group_roles,
            'fake_pwd'    => $fake_pwd
        ];
    }

    public function readOne($id)
    {
        $one = $this->userRepo->oneSkeleton($id)->first();

        $user_roles    = $this->userRoleRepo->readByUserId($one->id)->pluck('role_id')->toArray();
        $user_position = $this->userPositionRepo->readByUserId($one->id)->pluck('position_id')->toArray();

        return [
            $this->table_name => $one,
            'user_roles'      => $user_roles,
            'user_position'   => $user_position
        ];
    }

    public function createOne($data)
    {
        $i_user           = $data['user'];
        $i_user_roles     = $data['user_roles'];
        $i_user_positions = $data['user_positions'];
//        $i_field          = $data['field'];

        try {
            DB::beginTransaction();

            $i_one = [
                'code'         => $this->userRepo->generateCode('USER'),
                'fullname'     => $i_user['fullname'],
                'username'     => $i_user['username'],
                'password'     => $i_user['password'],
                'address'      => $i_user['address'],
                'phone'        => $i_user['phone'],
                'birthday'     => DateTimeHelper::toStringDateTimeClientForDB($i_user['birthday'], 'd/m/Y'),
                'sex'          => $i_user['sex'],
                'email'        => $i_user['email'],
                'note'         => $i_user['note'],
                'created_by'   => $this->user->id,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => null,
                'active'       => true
            ];

            $one = $this->userRepo->create($i_one);

            if (!$one) {
                DB::rollback();
                return false;
            }

            // Insert UserRole
            foreach ($i_user_roles as $i_user_role) {
                $i_two = [
                    'user_id'      => $one->id,
                    'role_id'      => $i_user_role,
                    'created_by'   => $one->created_by,
                    'updated_by'   => 0,
                    'created_date' => $one->created_date,
                    'updated_date' => null,
                    'active'       => true
                ];
                $two   = $this->userRoleRepo->create($i_two);

                if (!$two) {
                    DB::rollback();
                    return false;
                }
            }

            // Insert UserPosition
            foreach ($i_user_positions as $i_user_position) {
                $i_three = [
                    'user_id'      => $one->id,
                    'position_id'  => $i_user_position,
                    'created_by'   => $one->created_by,
                    'updated_by'   => 0,
                    'created_date' => $one->created_date,
                    'updated_date' => null,
                    'active'       => true
                ];
                $three   = $this->userPositionRepo->create($i_three);

                if (!$three) {
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
        $i_user           = $data['user'];
        $i_user_roles     = $data['user_roles'];
        $i_user_positions = $data['user_positions'];
//        $i_field          = $data['field'];

        try {
            DB::beginTransaction();

            $one = $this->userRepo->find($i_user['id']);

            $i_one = [
                'fullname'     => $i_user['fullname'],
                'username'     => $i_user['username'],
                'password'     => $i_user['password'],
                'address'      => $i_user['address'],
                'phone'        => $i_user['phone'],
                'birthday'     => DateTimeHelper::toStringDateTimeClientForDB($i_user['birthday'], 'd/m/Y'),
                'sex'          => $i_user['sex'],
                'email'        => $i_user['email'],
                'note'         => $i_user['note'],
                'updated_by'   => $this->user->id,
                'updated_date' => date('Y-m-d H:i:s'),
                'active'       => true
            ];

            $one = $this->userRepo->update($one, $i_one);

            if (!$one) {
                DB::rollback();
                return false;
            }

            # Delete UserRole
            $this->userRoleRepo->deleteByUserId($one->id);

            // Insert UserRole
            foreach ($i_user_roles as $i_user_role) {
                $i_two = [
                    'user_id'      => $one->id,
                    'role_id'      => $i_user_role,
                    'created_by'   => $one->created_by,
                    'updated_by'   => 0,
                    'created_date' => $one->created_date,
                    'updated_date' => null,
                    'active'       => true
                ];
                $two   = $this->userRoleRepo->create($i_two);

                if (!$two) {
                    DB::rollback();
                    return false;
                }
            }

            # Delete UserPosition
            $this->userPositionRepo->deleteByUserId($one->id);

            // Insert UserPosition
            foreach ($i_user_positions as $i_user_position) {
                $i_three = [
                    'user_id'      => $one->id,
                    'position_id'  => $i_user_position,
                    'created_by'   => $one->created_by,
                    'updated_by'   => 0,
                    'created_date' => $one->created_date,
                    'updated_date' => null,
                    'active'       => true
                ];
                $three   = $this->userPositionRepo->create($i_three);

                if (!$three) {
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

            $one = $this->userRepo->deactivate($id) ? true : false;

            if (!$one) {
                DB::rollBack();
                return false;
            }

            # Deactivate UserRole
            $this->userRoleRepo->deactivateByUserId($id);

            # Deactivate UserPosition
            $this->userPositionRepo->deactivateByUserId($id);

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

            $one = $this->userRepo->destroy($id) ? true : false;
            if (!$one) {
                DB::rollBack();
                return false;
            }

            # Delete UserRole
            $this->userRoleRepo->deleteByUserId($id);

            # Delete UserPosition
            $this->userPositionRepo->deleteByUserId($id);

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
