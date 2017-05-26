<?php

use Illuminate\Database\Seeder;

class FuelCustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = \App\Customer::all();
        $fuels     = \App\Fuel::where('type', 'oil')->get();

        foreach ($customers as $customer) {
            \App\FuelCustomer::create([
                'fuel_id'      => $fuels[0]->id,
                'customer_id'  => $customer->id,
                'price'        => $fuels[0]->price,
                'type'         => 'OIL',
                'apply_date'   => $fuels[0]->apply_date,
                'note'         => '',
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true
            ]);
        }
    }
}
