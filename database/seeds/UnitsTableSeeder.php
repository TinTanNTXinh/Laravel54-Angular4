<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

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
            'đ/Chuyến',
            'đ/Kg',
            'đ/Tấn',
            'đ/Pallet',
            'đ/Khối',
            'đ/Thùng',
            'đ/Cây'
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
