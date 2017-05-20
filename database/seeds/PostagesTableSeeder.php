<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

class PostagesTableSeeder extends Seeder
{
    use DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # FORMOSA #
        $FORMOSA_UNIT_PRICE = [144500, 234300, 814700];
        foreach($FORMOSA_UNIT_PRICE as $key => $unit_price) {
            \App\Postage::create([
                'code'  => $this->generateCode(\App\Postage::class, 'POSTAGE'),
                'unit_price'    => $unit_price,
                'delivery_percent' => 10.00,
                'apply_date'    => '2016-10-10',
                'change_by_fuel' => 0,
                'note'         => '',
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true,
                'customer_id'  => 1,
                'unit_id'      => 1,
                'fuel_id'      => 1
            ]);
        }

        # A CHAU #
        $ACHAU_UNIT_PRICE = [1513, 5036];
        foreach($ACHAU_UNIT_PRICE as $key => $unit_price) {
            \App\Postage::create([
                'code'  => $this->generateCode(\App\Postage::class, 'POSTAGE'),
                'unit_price'    => $unit_price,
                'delivery_percent' => 10.00,
                'apply_date'    => '2016-10-10',
                'change_by_fuel' => 0,
                'note'         => '',
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true,
                'customer_id'  => 2,
                'unit_id'      => 1,
                'fuel_id'      => 1
            ]);
        }
    }
}
