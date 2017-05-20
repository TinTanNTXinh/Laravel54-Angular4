<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

class CustomersTableSeeder extends Seeder
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
            'FORMOSA',
            'CTY CP THỰC PHẨM Á CHÂU',
            'CTY TNHH YCH-PROTRADE',
            'CTY TNHH SGC TRADING VIET NAM',
            'CTY TNHH SX TM DV ĐOÀN KẾT',
            'CTY TNHH INDO-TRANS KEPPEL LOGISTICS VIỆT NAM',
            'CTY TNHH AUNTEX',
            'CTY PHẦN MỀM TIN TẤN',
        ];

        foreach ($array_name as $item) {
            \App\Customer::create([
                'code'             => $this->generateCode(\App\Customer::class, 'CUSTOMER'),
                'tax_code'         => mt_rand(100000000, 999999999),
                'fullname'         => $item,
                'address'          => '662 Le Quang Dinh',
                'phone'            => '0987654321',
                'email'            => 'mycompany@company.com',
                'limit_oil'        => 10,
                'oil_per_postage'  => 10,
                'note'             => '',
                'created_by'       => 1,
                'updated_by'       => 0,
                'created_date'     => date('Y-m-d'),
                'updated_date'     => null,
                'active'           => true,
                'customer_type_id' => 1
            ]);
        }
    }
}
