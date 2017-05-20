<?php

use Illuminate\Database\Seeder;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CODEs = ['S', 'R', 'P', 'O', 'PC'];
        $NAMEs = ['Single', 'Range', 'Pair', 'Oil', 'ProductCode'];
        $DESCRIPTIONs = ['Giá trị', 'Một khoảng', 'Một cặp', 'Giá dầu', 'Mã hàng'];

        foreach ($CODEs as $key => $code) {
            \App\Rule::create([
                'code'        => $code,
                'name'        => $NAMEs[$key],
                'description' => $DESCRIPTIONs[$key],
                'active'      => true
            ]);
        }
    }
}
