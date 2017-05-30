<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class GroupRolesTableSeeder extends Seeder
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
            'Mặc định',
            'QL người dùng',
            'QL khách hàng',
            'QL Xe - Tài xế',
            'QL công nợ',
            'QL chi phí',
            'QL nhiên liệu',
            'Báo cáo'
        ];

        $array_index = [
            1, 2, 3, 4, 7, 6, 5, 8
        ];

        $array_icon_name = [
            '',
            'fa fa-universal-access icon',
            'fa fa-wrench icon',
            'fa fa-truck icon',
            'fa fa-money icon',
            'fa fa-calendar-o icon',
            'fa fa-tint icon',
            'fa fa-bar-chart icon'
        ];

        foreach($array_name as $key => $name){
            \App\GroupRole::create([
                'code'        => $this->generateCode(\App\GroupRole::class, 'GROUP_ROLE'),
                'name'        => $array_name[$key],
                'description' => '',
                'icon_name'   => $array_icon_name[$key],
                'index'       => $array_index[$key],
                'active'      => true
            ]);
        }
    }
}
