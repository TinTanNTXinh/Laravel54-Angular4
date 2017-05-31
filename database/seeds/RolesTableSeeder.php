<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class RolesTableSeeder extends Seeder
{
    use DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_name = [
            'Dashboard', // 1
            'Position', // 2
            'User', // 3
            'Driver', // 10
            'Truck', // 9
            'Customer', // 4
            'Transport', // 7
            'Garage', // 8
            'InvoiceCustomer', // 17
            'InvoiceGarage', // 18
            'CostOil', // 13
            'CostLube', // 14
            'CostParking', // 15
            'CostOther', // 16
            'Postage', // 6
            'Oil', // 11
            'Lube', // 12
            'ReportRevenue', // 19
            'HistoryTransport', // 20
            'StaffCustomer' // 5
        ];

        $array_group_id = [
            1,
            2,
            2,
            4,
            4,
            3,
            3,
            4,
            5,
            5,
            6,
            6,
            6,
            6,
            3,
            7,
            7,
            8,
            8,
            3
        ];

        $array_index = [
            1, 2, 3, 10, 9, 4, 7, 8, 17, 18, 13, 14, 15, 16, 6, 11, 12, 19, 20, 5
        ];

        $array_description = [
            'Trang chủ',
            'Chức vụ',
            'Người dùng',
            'Tài xế',
            'Xe',
            'Khách hàng',
            'Đơn hàng',
            'Nhà xe',
            'Khách hàng',
            'Nhà xe',
            'Dầu',
            'Nhớt',
            'Đậu bãi',
            'Khác',
            'Cước phí',
            'Dầu',
            'Nhớt',
            'Doanh thu',
            'Lịch sử giao hàng',
            'Nhân viên khách hàng'
        ];

        $array_icon_name = [
            'fa fa-dashboard icon text-primary-lter',
            'fa fa-sitemap icon text-danger-lter',
            'fa fa-male icon text-danger-lter',
            'fa fa-id-card icon text-danger-lter',
            'fa fa-truck icon text-info-lter',
            'fa fa-users icon text-info-lter',
            'fa fa-shopping-cart icon text-success-lter',
            'fa fa-home icon text-success-lter',
            'fa fa-credit-card icon text-success-lter',
            'fa fa-credit-card icon text-info-lter',
            'fa fa-tint icon text-warning-lter',
            'fa fa-tint icon text-warning-lter',
            'fa fa-road icon text-info-lter',
            'fa fa-ellipsis-h icon text-info-lter',
            'fa fa-calendar-o icon text-success-lter',
            'fa fa-tint icon text-warning-lter',
            'fa fa-tint icon text-warning-lter',
            'fa fa-calculator icon text-primary-lter',
            'fa fa-calculator icon text-primary-lter',
            'fa fa-user icon text-info-lter'
        ];

        foreach ($array_name as $key => $name) {
            $router_link = $array_name[$key] == 'IOCenter' ? 'IoCenter' : $array_name[$key];
            \App\Role::create([
                'code'          => $this->generateCode(\App\Role::class, 'ROLE'),
                'name'          => $array_name[$key],
                'description'   => $array_description[$key],
                'router_link'   => '/' . strtolower(preg_replace('/\B([A-Z])/', '-$1', $router_link)) . 's',
                'icon_name'     => $array_icon_name[$key],
                'index'         => $array_index[$key],
                'group_role_id' => $array_group_id[$key],
                'active'        => true
            ]);
        }
    }
}
