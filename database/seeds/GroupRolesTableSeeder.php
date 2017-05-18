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
            'QL nhà xe',
            'QL công nợ',
            'QL chi phí',
            'QL nhiên liệu',
            'QL báo cáo'
        ];

        foreach($array_name as $key => $name){
            \App\GroupRole::create([
                'code'        => $this->generateCode(\App\GroupRole::class, 'GROUP_ROLE'),
                'name'        => $array_name[$key],
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
