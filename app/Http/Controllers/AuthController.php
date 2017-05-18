<?php

namespace App\Http\Controllers;

use App\GroupRole;
use App\User;
use App\Role;
use App\UserRole;
use Hash;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Traits\UserHelper;

class AuthController extends Controller
{
    use UserHelper;

    /** API METHOD */
    public function postAuthentication(Request $request)
    {
        $arr_datas = $this->authentication($request->input('user'));
        return response()->json($arr_datas, $arr_datas['status_code']);
    }

    public function getAuthorization()
    {
        $arr_datas = $this->authorization();
        return response()->json($arr_datas, $arr_datas['status_code']);
    }

    /** LOGIC METHOD */
    public function authentication($data)
    {
        if ($data['username'] == null || $data['username'] == '' || $data['password'] == null || $data['password'] == '')
            return ['error' => 'Tên tài khoản hoặc mật khẩu không hợp lệ.', 'error_en' => 'username or password is empty', 'status_code' => 404];

        $user = User::whereActive(true)->where('username', $data['username'])->first();

        if (!$user) {
            return ['error' => 'Người dùng không tồn tại.', 'error_en' => 'user is not exist', 'status_code' => 401];
        }
        $password_check = Hash::check($data['password'], $user->password);
        if (!$password_check) {
            return ['error' => 'Mật khẩu không hợp lệ.', 'error_en' => 'password is not correct', 'status_code' => 401];
        }

        try {
            if (!$token = JWTAuth::fromUser($user)) {
                return ['error' => 'Không thể tạo phiên đăng nhập mới.', 'error_en' => 'could_not_create_token', 'status_code' => 401];
            }
            return ['token' => $token, 'status_code' => 200];
        } catch (JWTException $e) {
            return ['error' => 'Không thể tạo phiên đăng nhập mới.', 'error_en' => 'could_not_create_token', 'status_code' => 500];
        }
    }

    public function authorization()
    {
        $jwt_data = $this->getCurrentUser();
        if (!$jwt_data['status']) {
            return [
                'error'    => $jwt_data['error'],
                'error_en'    => $jwt_data['error_en'],
                'status_code' => $jwt_data['http_status_code']
            ];
        }

        $user_data = $this->getInfoCurrentUser($jwt_data['user']);
        if (!$user_data['status']) {
            return [
                'error'    => $user_data['error'],
                'error_en'    => $user_data['error_en'],
                'status_code' => $user_data['http_status_code']
            ];
        }

        $user = $user_data['user'];

        $user_roles = UserRole::where([['active', true], ['user_id', $user->id]])->pluck('role_id')->toArray();
        if (!$user_roles)
            return ['error' => 'user_role is not exist', 'status_code' => 401];

        $roles = Role::whereIn('id', $user_roles)->orderBy('index')->get()->toArray();
        if (!$roles)
            return ['error' => 'role is not exist', 'status_code' => 401];

        $group_roles = GroupRole::whereActive(true)->get();

        return [
            'user' => $user,
            'roles' => $roles,
            'group_roles' => $group_roles,
            'status_code' => 201
        ];
    }
}
