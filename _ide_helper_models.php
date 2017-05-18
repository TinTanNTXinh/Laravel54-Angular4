<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Role
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property string $router_link router link cho angular
 * @property string $icon_name icon cho aside
 * @property int $index vị trí thứ tự
 * @property bool $active Kích hoạt
 * @property int $group_role_id Nhóm quyền
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereGroupRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereIconName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereIndex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereRouterLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\UserPosition
 *
 * @property int $id
 * @property int $user_id Nguời dùng
 * @property int $position_id Nguời dùng
 * @property int $created_by Người tạo
 * @property int $updated_by Người cập nhật
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition wherePositionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserPosition whereUserId($value)
 */
	class UserPosition extends \Eloquent {}
}

namespace App{
/**
 * App\UserRole
 *
 * @property int $id
 * @property int $user_id Nguời dùng
 * @property int $role_id Quyền
 * @property int $created_by Người tạo
 * @property int $updated_by Người cập nhật
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserRole whereUserId($value)
 */
	class UserRole extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $code Mã
 * @property string $fullname Họ tên
 * @property string $username Tài khoản
 * @property string $password Mật khẩu
 * @property string $address Địa chỉ
 * @property string $phone Điện thoại
 * @property string $birthday Ngày sinh
 * @property string $sex Giới tính
 * @property string $email Email
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFullname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\File
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $extension Phần mở rộng
 * @property string $mime_type MIME Type
 * @property string $path Đường dẫn
 * @property int $size Dung lượng
 * @property string $table_name Tên bảng
 * @property int $table_id Mã bảng
 * @property string $note Ghi chú
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\File whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereExtension($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereMimeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereTableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereTableName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereUpdatedDate($value)
 */
	class File extends \Eloquent {}
}

namespace App{
/**
 * App\GroupRole
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereUpdatedAt($value)
 */
	class GroupRole extends \Eloquent {}
}

namespace App{
/**
 * App\Unit
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereUpdatedAt($value)
 */
	class Unit extends \Eloquent {}
}

namespace App{
/**
 * App\Field
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $is_read
 * @property bool $is_create
 * @property bool $is_update
 * @property bool $is_delete
 * @property bool $active Kích hoạt
 * @property int $role_id Quyền
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereIsCreate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereIsDelete($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereIsRead($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereIsUpdate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereRoleId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereUpdatedAt($value)
 */
	class Field extends \Eloquent {}
}

namespace App{
/**
 * App\Position
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Position whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Position whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Position whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Position whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Position whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Position whereUpdatedAt($value)
 */
	class Position extends \Eloquent {}
}

