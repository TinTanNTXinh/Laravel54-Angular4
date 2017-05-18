<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

class PositionsTableSeeder extends Seeder
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
            'System Admin',
            'Super Admin',
        	'Quản trị viên',
        	'Nhân viên nhập hàng',
        	'Nhân viên xuất hàng',
            'Khách vãng lai'
        ];

        $array_code = [
            'SA',
            'SV',
        	'QTV',
        	'NVNH',
        	'NVXH',
            'KVL'
        ];

        foreach($array_name as $key => $name){
            \App\Position::create([
            	'code'		  => $this->generateCode(\App\Position::class, 'POSITION'),
                'name'        => $array_name[$key],
                'description' => $array_name[$key],
                'active'      => true
            ]);
        }
    }
}
