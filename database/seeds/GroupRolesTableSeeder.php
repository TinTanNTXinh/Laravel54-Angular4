<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

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
            'glyphicon-cog icon',
            'glyphicon-wrench icon',
            'glyphicon-phone icon',
            'glyphicon-th-large icon',
            'glyphicon-book icon',
            'glyphicon-plane icon',
            'glyphicon-shopping-cart icon'
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
