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
        $CODEs = ['SINGLE', 'RANGE', 'PAIR', 'OIL'];
        $NAMEs = ['Giá trị', 'Một khoảng', 'Một cặp', 'Giá dầu'];

        foreach ($CODEs as $key => $code) {
            \App\Rule::create([
                'code'        => $code,
                'name'        => $NAMEs[$key],
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
