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
            'Dashboard',
            'Position',
            'User',
            'Driver',
            'Truck',
            'Customer',
            'Transport',
            'Garage',
            'InvoiceCustomer',
            'InvoiceGarage',
            'CostOil',
            'CostLube',
            'CostPark',
            'CostOther',
            'Postage',
            'FuelOil',
            'FuelLube',
            'ReportRevenue',
            'HistoryTransport'
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
            8
        ];

        $array_index = [
            1, 2, 3, 8, 5, 6, 15, 4, 9, 10, 11, 12, 13, 14, 7, 16, 17, 18, 19
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
            'Lịch sử giao hàng'
        ];

        $array_icon_name = [
            'glyphicon-stats icon text-primary-lter',
            'glyphicon-cog icon text-danger-lter',
            'glyphicon-wrench icon text-danger-lter',
            'glyphicon-phone icon text-danger-lter',
            'glyphicon-th-large icon text-info-lter',
            'glyphicon-book icon text-info-lter',
            'glyphicon-plane icon text-success-lter',
            'glyphicon-shopping-cart icon text-success-lter',
            'glyphicon-user icon text-success-lter',
            'glyphicon-home icon text-success-lter',
            'glyphicon-tint icon text-info-lter',
            'glyphicon-inbox icon text-warning-lter',
            'glyphicon-credit-card icon text-warning-lter',
            'glyphicon-eye-close icon text-info-lter',
            'glyphicon-folder-open icon text-info-lter',
            'glyphicon-folder-open icon text-info-lter',
            'glyphicon-user icon text-info-lter',
            'glyphicon-user icon text-info-lter',
            'glyphicon-folder-open icon text-info-lter'
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
