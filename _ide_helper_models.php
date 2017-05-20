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
 * App\Formula
 *
 * @property int $id
 * @property string $code Mã
 * @property string $rule
 * @property string $name
 * @property int $from
 * @property int $to
 * @property string $from_place
 * @property string $to_place
 * @property string $value
 * @property int $index
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $postage_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereFromPlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereIndex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula wherePostageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereRule($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereToPlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Formula whereValue($value)
 */
	class Formula extends \Eloquent {}
}

namespace App{
/**
 * App\Voucher
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Voucher whereUpdatedAt($value)
 */
	class Voucher extends \Eloquent {}
}

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
 * App\Driver
 *
 * @property int $id
 * @property string $code Mã
 * @property string $fullname Họ tên
 * @property string $phone Điện thoại
 * @property string $birthday Ngày sinh
 * @property string $sex Giới tính
 * @property string $email Email
 * @property string $dia_chi_thuong_tru
 * @property string $dia_chi_tam_tru
 * @property string $so_chung_minh
 * @property string $ngay_cap_chung_minh
 * @property string $loai_bang_lai
 * @property string $so_bang_lai
 * @property string $ngay_cap_bang_lai
 * @property string $ngay_het_han_bang_lai
 * @property string $start_date Ngày vào làm
 * @property string $finish_date Ngày nghĩ việc
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereDiaChiTamTru($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereDiaChiThuongTru($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereFinishDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereFullname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereLoaiBangLai($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereNgayCapBangLai($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereNgayCapChungMinh($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereNgayHetHanBangLai($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereSoBangLai($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereSoChungMinh($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Driver whereUpdatedDate($value)
 */
	class Driver extends \Eloquent {}
}

namespace App{
/**
 * App\InvoiceDetail
 *
 * @property int $id
 * @property float $paid_amt
 * @property string $pay_date Ngày trả
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $invoice_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereInvoiceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail wherePaidAmt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail wherePayDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\InvoiceDetail whereUpdatedDate($value)
 */
	class InvoiceDetail extends \Eloquent {}
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
 * App\Invoice
 *
 * @property int $id
 * @property string $code Mã
 * @property string $kind
 * @property string $type
 * @property string $status
 * @property int $customer_id
 * @property float $total_revenue Tổng doanh thu
 * @property float $total_receive Tổng doanh thu
 * @property float $vat vat
 * @property float $after_vat Tổng tiền sau vat
 * @property int $truck_id
 * @property float $total_delivery Tổng doanh thu
 * @property float $total_cost Tổng doanh thu
 * @property float $total_cost_in_transport Tổng doanh thu
 * @property float $total_pay Tổng doanh thu
 * @property float $total_paid Tổng doanh thu
 * @property string $invoice_date
 * @property string $receiver
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereAfterVat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereInvoiceDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereKind($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereReceiver($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTotalCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTotalCostInTransport($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTotalDelivery($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTotalPaid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTotalPay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTotalReceive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTotalRevenue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereTruckId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Invoice whereVat($value)
 */
	class Invoice extends \Eloquent {}
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
 * App\Transport
 *
 * @property int $id
 * @property string $code Mã
 * @property string $transport_date Ngày vận chuyển
 * @property string $type 1
 * @property int $quantum_product Số lượng sản phẩm
 * @property float $revenue Doanh thu
 * @property float $profit Lợi nhuận
 * @property float $receive Nhận
 * @property float $delivery Giao xe
 * @property float $carrying Bốc xếp
 * @property float $parking Neo đêm
 * @property float $fine Công an
 * @property float $phi_tang_bo Phí tăng bo
 * @property float $add_score Thêm điểm
 * @property float $delivery_real Giao xe thực tế
 * @property float $carrying_real Bốc xếp thực tế
 * @property float $parking_real Neo đêm thực tế
 * @property float $fine_real Công an thực tế
 * @property float $phi_tang_bo_real Phí tăng bo thực tế
 * @property float $add_score_real Thêm điểm thực tế
 * @property string $voucher_number Số chứng từ
 * @property string $quantum_product_on_voucher Số lượng sản phẩm trên chứng từ
 * @property string $receiver Người nhận
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $truck_id
 * @property int $product_id
 * @property int $customer_id
 * @property int $postage_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereAddScore($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereAddScoreReal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereCarrying($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereCarryingReal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereDelivery($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereDeliveryReal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereFine($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereFineReal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereParking($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereParkingReal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport wherePhiTangBo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport wherePhiTangBoReal($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport wherePostageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereProfit($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereQuantumProduct($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereQuantumProductOnVoucher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereReceive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereReceiver($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereRevenue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereTransportDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereTruckId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Transport whereVoucherNumber($value)
 */
	class Transport extends \Eloquent {}
}

namespace App{
/**
 * App\Garage
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property string $address
 * @property string $contactor
 * @property string $phone
 * @property string $note
 * @property bool $active Kích hoạt
 * @property int $garage_type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereContactor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereGarageTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Garage whereUpdatedAt($value)
 */
	class Garage extends \Eloquent {}
}

namespace App{
/**
 * App\TransportFormula
 *
 * @property int $id
 * @property string $rule
 * @property string $name
 * @property string $value
 * @property string $from_place
 * @property string $to_place
 * @property bool $active Kích hoạt
 * @property int $transport_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereFromPlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereRule($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereToPlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereTransportId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportFormula whereValue($value)
 */
	class TransportFormula extends \Eloquent {}
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
 * App\Rule
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Rule whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rule whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rule whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rule whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rule whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rule whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Rule whereUpdatedAt($value)
 */
	class Rule extends \Eloquent {}
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
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\File whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereCreatedBy($value)
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
 * @method static \Illuminate\Database\Query\Builder|\App\File whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\File whereUpdatedDate($value)
 */
	class File extends \Eloquent {}
}

namespace App{
/**
 * App\Postage
 *
 * @property int $id
 * @property string $code Mã
 * @property float $unit_price Đơn giá trên mỗi đơn vị tính
 * @property float $delivery_percent Phần trăm giao xe
 * @property string $apply_date
 * @property bool $change_by_fuel Tạo do nhiên liệu thay đổi
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $customer_id
 * @property int $unit_id
 * @property int $fuel_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereApplyDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereChangeByFuel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereDeliveryPercent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereFuelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereUnitPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Postage whereUpdatedDate($value)
 */
	class Postage extends \Eloquent {}
}

namespace App{
/**
 * App\DriverTruck
 *
 * @property int $id
 * @property int $driver_id 1
 * @property int $truck_id 1
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereDriverId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereTruckId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\DriverTruck whereUpdatedDate($value)
 */
	class DriverTruck extends \Eloquent {}
}

namespace App{
/**
 * App\FuelCustomer
 *
 * @property int $id
 * @property int $fuel_id
 * @property int $customer_id
 * @property float $price Giá dầu làm mốc của khách hàng
 * @property string $type
 * @property string $apply_date
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereApplyDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereFuelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FuelCustomer whereUpdatedDate($value)
 */
	class FuelCustomer extends \Eloquent {}
}

namespace App{
/**
 * App\Fuel
 *
 * @property int $id
 * @property string $code Mã
 * @property float $price Giá nhiên liệu
 * @property string $type
 * @property string $apply_date
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereApplyDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Fuel whereUpdatedDate($value)
 */
	class Fuel extends \Eloquent {}
}

namespace App{
/**
 * App\ProductCode
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property int $product_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCode whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCode whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCode whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCode whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCode whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCode whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCode whereUpdatedAt($value)
 */
	class ProductCode extends \Eloquent {}
}

namespace App{
/**
 * App\Customer
 *
 * @property int $id
 * @property string $code Mã
 * @property string $tax_code Mã số thuế
 * @property string $fullname Họ tên
 * @property string $address Địa chỉ
 * @property string $phone Điện thoại
 * @property string $email Email
 * @property float $limit_oil Số phần trăm khi giá dầu đạt mức này sẽ đổi cước phí
 * @property float $oil_per_postage Số phần trăm giá dầu/cước phí
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $customer_type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCustomerTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereFullname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereLimitOil($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereOilPerPostage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereTaxCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedDate($value)
 */
	class Customer extends \Eloquent {}
}

namespace App{
/**
 * App\GarageType
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\GarageType whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GarageType whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GarageType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GarageType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GarageType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GarageType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GarageType whereUpdatedAt($value)
 */
	class GarageType extends \Eloquent {}
}

namespace App{
/**
 * App\TransportInvoice
 *
 * @property int $id
 * @property int $transport_id
 * @property int $invoice_id
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereInvoiceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereTransportId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TransportInvoice whereUpdatedDate($value)
 */
	class TransportInvoice extends \Eloquent {}
}

namespace App{
/**
 * App\Cost
 *
 * @property int $id
 * @property string $code Mã
 * @property float $money Chi phí
 * @property float $vat 1
 * @property float $after_vat Chi phí sau khi có vat
 * @property string $type
 * @property int $fuel_id
 * @property float $quantum_liter Số lít dầu/nhớt
 * @property string $refuel_date Ngày đổ dầu/nhớt
 * @property int $unit_price_park_id
 * @property string $checkin_date Ngày đậu bãi
 * @property string $checkout_date Ngày ra bãi
 * @property int $total_day Tổng ngày đậu bãi
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $truck_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereAfterVat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereCheckinDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereCheckoutDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereFuelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereQuantumLiter($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereRefuelDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereTotalDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereTruckId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereUnitPriceParkId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cost whereVat($value)
 */
	class Cost extends \Eloquent {}
}

namespace App{
/**
 * App\GroupRole
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property string $icon_name icon cho aside
 * @property int $index vị trí thứ tự
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereIconName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereIndex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\GroupRole whereUpdatedAt($value)
 */
	class GroupRole extends \Eloquent {}
}

namespace App{
/**
 * App\StaffCustomer
 *
 * @property int $id
 * @property string $code Mã
 * @property string $fullname Họ tên
 * @property string $address Địa chỉ
 * @property string $phone Điện thoại
 * @property string $birthday Ngày sinh
 * @property string $sex Giới tính
 * @property string $email Email
 * @property string $position Chức vụ
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $customer_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereBirthday($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereFullname($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\StaffCustomer whereUpdatedDate($value)
 */
	class StaffCustomer extends \Eloquent {}
}

namespace App{
/**
 * App\CustomerType
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerType whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerType whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CustomerType whereUpdatedAt($value)
 */
	class CustomerType extends \Eloquent {}
}

namespace App{
/**
 * App\VoucherTransport
 *
 * @property int $id
 * @property int $voucher_id
 * @property int $transport_id
 * @property int $quantum Số lượng chứng từ
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereQuantum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereTransportId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\VoucherTransport whereVoucherId($value)
 */
	class VoucherTransport extends \Eloquent {}
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
 * App\Truck
 *
 * @property int $id
 * @property string $code Mã
 * @property string $area_code Mã vùng
 * @property string $number_plate Số xe
 * @property string $trademark Hãng xe
 * @property int $year_of_manufacture Năm sản xuất
 * @property string $owner Chủ xe
 * @property int $length Dài
 * @property int $width Rộng
 * @property int $height Cao
 * @property string $status
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $truck_type_id
 * @property int $garage_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereAreaCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereGarageId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereLength($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereNumberPlate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereOwner($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereTrademark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereTruckTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereUpdatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereWidth($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereYearOfManufacture($value)
 */
	class Truck extends \Eloquent {}
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
 * App\TruckType
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property float $weight Trọng tải
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TruckType whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckType whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckType whereWeight($value)
 */
	class TruckType extends \Eloquent {}
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

namespace App{
/**
 * App\Product
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property int $product_type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereProductTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App{
/**
 * App\ProductType
 *
 * @property int $id
 * @property string $code Mã
 * @property string $name Tên
 * @property string $description Mô tả
 * @property bool $active Kích hoạt
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereUpdatedAt($value)
 */
	class ProductType extends \Eloquent {}
}

namespace App{
/**
 * App\UnitPricePark
 *
 * @property int $id
 * @property string $code Mã
 * @property float $price Đơn giá cho loại xe
 * @property string $note Ghi chú
 * @property int $created_by Người tạo
 * @property int $updated_by Người sửa
 * @property string $created_date Ngày tạo
 * @property string $updated_date Ngày cập nhật
 * @property bool $active Kích hoạt
 * @property int $truck_type_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereCreatedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereNote($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereTruckTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UnitPricePark whereUpdatedDate($value)
 */
	class UnitPricePark extends \Eloquent {}
}

