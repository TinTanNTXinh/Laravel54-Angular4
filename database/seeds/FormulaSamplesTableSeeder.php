<?php

use Illuminate\Database\Seeder;

class FormulaSamplesTableSeeder extends Seeder
{
    use \App\Traits\Common\DBHelper;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = [
            'OIL',
            'PAIR',
            'RANGE',
            'SINGLE',
            'SINGLE',
            'SINGLE'
        ];

        $names = [
            'Giá dầu',
            'Tuyến đường',
            'Khoảng cách',
            'Mã hàng',
            '1 chiều/2 chiều',
            'Loại xe'
        ];

        $indexs = [
            2,
            1,
            3,
            4,
            5,
            6
        ];

        foreach($names as $key => $name)
        {
            \App\FormulaSample::create([
                'code'         => $this->generateCode(\App\FormulaSample::class, 'FORMULASAMPLE'),
                'rule'         => $rules[$key],
                'name'         => $name,
                'index'        => $indexs[$key],
                'active'       => true
            ]);
        }
    }
}
