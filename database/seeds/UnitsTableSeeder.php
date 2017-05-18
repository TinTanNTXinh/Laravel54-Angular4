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
            'Thùng',
            'Hộp',
            'Cái',
            'Đôi',
            'Chiếc',
            'Lon',
            'Chai',
            'Dây'
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
