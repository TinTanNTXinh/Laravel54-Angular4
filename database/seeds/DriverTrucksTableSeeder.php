<?php

use Illuminate\Database\Seeder;

class DriverTrucksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $driver_ids = \App\Driver::all()->pluck('id')->toArray();
        $truck_ids = \App\Truck::all()->pluck('id')->toArray();
        foreach($truck_ids as $key => $truck_id) {
            \App\DriverTruck::create([
                'driver_id'    => $driver_ids[$key],
                'truck_id'     => $truck_id,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true
            ]);
        }
    }
}
