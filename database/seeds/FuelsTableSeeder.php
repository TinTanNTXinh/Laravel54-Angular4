<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class FuelsTableSeeder extends Seeder
{
    use DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_price = 10000;

        $types = ['OIL', 'LUBE'];
        foreach ($types as $type) {
            \App\Fuel::create([
                'code'         => $this->generateCode(\App\Fuel::class, $type),
                'price'        => $default_price,
                'type'         => $type,
                'apply_date'   => '2016-01-01 00:00:00',
                'note'         => 'Giá mặc định ban đầu',
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true
            ]);
        }
    }
}
