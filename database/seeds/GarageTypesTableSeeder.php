<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class GarageTypesTableSeeder extends Seeder
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
            'Xe công ty',
            'Xe ngoài'
        ];

        foreach ($array_name as $name) {
            \App\GarageType::create([
                'code'        => $this->generateCode(\App\GarageType::class, 'GARAGETYPE'),
                'name'        => $name,
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
