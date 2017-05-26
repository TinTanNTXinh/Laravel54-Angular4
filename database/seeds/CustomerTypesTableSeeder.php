<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class CustomerTypesTableSeeder extends Seeder
{
    use DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\CustomerType::create([
            'code'        => $this->generateCode(\App\CustomerType::class, 'CUSTOMERTYPE'),
            'name'        => 'Công ty',
            'description' => '',
            'active'      => true
        ]);
        \App\CustomerType::create([
            'code'        => $this->generateCode(\App\CustomerType::class, 'CUSTOMERTYPE'),
            'name'        => 'Cá nhân',
            'description' => '',
            'active'      => true
        ]);
    }
}
