<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

class UnitsTableSeeder extends Seeder
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
            'VNĐ/Kg',
            'VNĐ/Tấn',
            'VNĐ/Chuyến',
            'VNĐ/Pallet',
            'VNĐ/Khối',
            'VNĐ/Thùng',
            'VNĐ/Cây'
        ];

        foreach ($array_name as $name) {
            \App\Unit::create([
                'code'        => $this->generateCode(\App\Unit::class, 'UNIT'),
                'name'        => $name,
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
