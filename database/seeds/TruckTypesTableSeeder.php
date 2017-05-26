<?php

use Illuminate\Database\Seeder;

class TruckTypesTableSeeder extends Seeder
{
    use \App\Traits\Common\DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_name   = [
            'Xe container',
            'Xe tải',
            'Xe tải'
        ];
        $array_weight = [
            0, 8, 5
        ];

        foreach ($array_name as $key => $name) {
            \App\TruckType::create([
                'code'        => $this->generateCode(\App\TruckType::class, 'TRUCKTYPE'),
                'name'        => $name,
                'weight'      => $array_weight[$key],
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
