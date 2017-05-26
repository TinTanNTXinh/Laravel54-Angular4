<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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
            'Sợi',
            'Bông',
            'Bao vitamin',
            'Phuy hóa chất',
            'Kiện',
            'Bao',
            'Thùng'
        ];

        foreach ($array_name as $key => $name) {
            \App\Product::create([
                'code'            => $this->generateCode(\App\Product::class, 'PRODUCT'),
                'name'            => $name,
                'description'     => '',
                'active'          => true,
                'product_type_id' => 1
            ]);
        }
    }
}
