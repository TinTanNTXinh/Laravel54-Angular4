<?php

use Illuminate\Database\Seeder;

class VouchersTableSeeder extends Seeder
{
    use \App\Traits\Common\DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_name = [
            'HĐ xanh',
            'HĐ vàng',
            'HĐ hồng',
            'Phiếu cân',
            'Phiếu nhập kho',
            'Phiếu xuất kho',
            'Phiếu giao hàng',
            'Lịch giao hàng',
            'Chứng từ khác'
        ];

        foreach($array_name as $key => $name){
            \App\Voucher::create([
                'code'		  => $this->generateCode(\App\Voucher::class, 'VOUCHER'),
                'name'        => $array_name[$key],
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
