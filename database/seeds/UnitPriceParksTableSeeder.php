<?php

use Illuminate\Database\Seeder;

class UnitPriceParksTableSeeder extends Seeder
{
    use \App\Traits\Common\DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = [50000, 40000, 30000];

        foreach($prices as $key => $price) {
            \App\UnitPricePark::create([
                'code'          => $this->generateCode(\App\UnitPricePark::class, 'UNITPRICEPARK'),
                'price'         => $price,
                'note'          => '',
                'created_by'    => 1,
                'updated_by'    => 0,
                'created_date'  => date('Y-m-d'),
                'updated_date'  => null,
                'active'        => true,
                'truck_type_id' => ++$key
            ]);
        }
    }
}
