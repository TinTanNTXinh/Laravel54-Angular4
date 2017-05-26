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
        $faker         = \Faker\Factory::create();

        $types = ['oil', 'lube'];
        foreach ($types as $type) {
            \App\Fuel::create([
                'code'         => $this->generateCode(\App\Fuel::class, 'FUEL'),
                'price'        => $default_price,
                'type'         => $type,
                'apply_date'   => '2016-01-01 00:00:00',
                'note'         => $faker->sentence,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true
            ]);
        }
    }
}
