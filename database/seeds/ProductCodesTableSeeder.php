<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

class ProductCodesTableSeeder extends Seeder
{
    use DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_code = [
            'M', 'N', 'O', 'P'
        ];

        $product_ids = \App\Product::all()->pluck('id')->toArray();
        foreach ($product_ids as $key => $product_id) {
            foreach ($array_code as $code) {
                \App\ProductCode::create([
                    'code'        => $this->generateCode(\App\ProductCode::class, 'PRODUCTCODE'),
                    'name'        => $code,
                    'description' => '',
                    'active'      => true,
                    'product_id'  => $product_id
                ]);
            }
        }
    }
}
