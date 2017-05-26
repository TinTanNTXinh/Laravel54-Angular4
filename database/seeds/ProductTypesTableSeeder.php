<?php

use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    use \App\Traits\Common\DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_name = [
            'Thuốc',
            'Mỹ phẩm',
            'Hóa chất'
        ];
        foreach ($array_name as $item) {
            \App\ProductType::create([
                'code'        => $this->generateCode(\App\ProductType::class, 'PRODUCTTYPE'),
                'name'        => $item,
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
