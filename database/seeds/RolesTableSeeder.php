<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

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
            'GarageInside',
            'GarageOutside',
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
            1,
            1,
            3,
            3,
            4,
            4,
            5,
            5,
            6,
            6,
            6,
            6,
            1,
            7,
            7,
            8,
            8
        ];

        $array_index = [
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20
        ];

        $array_description = [
            'Trang chủ',
            'Chức vụ',
            'Người dùng',
            'QL tài xế',
            'QL xe',
            'Khách hàng',
            'Đơn hàng',
            'Nhà xe công ty',
            'Nhà xe ngoài',
            'Khách hàng',
            'Nhà xe',
            'Dầu',
            'Nhớt',
            'Đậu bãi',
            'Khác',
            'QL cước phí',
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
            'glyphicon-folder-open icon text-info-lter',
            'glyphicon-exclamation-sign icon text-danger-lter',
        ];

        foreach($array_name as $key => $name){
            $router_link = $array_name[$key] == 'IOCenter' ? 'IoCenter' : $array_name[$key];
            \App\Role::create([
                'code'        => $this->generateCode(\App\Role::class, 'ROLE'),
                'name'        => $array_name[$key],
                'description' => $array_description[$key],
                'router_link' => '/' . strtolower(preg_replace('/\B([A-Z])/', '-$1', $router_link)) . 's',
                'icon_name'   => $array_icon_name[$key],
                'index'       => $array_index[$key],
                'group_role_id' => $array_group_id[$key],
                'active'      => true
            ]);
        }
    }
}
