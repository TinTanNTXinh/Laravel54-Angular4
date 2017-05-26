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

        ];

        $names = [
            ''
        ];

        \App\FormulaSample::create([
            'code'         => $this->generateCode(\App\FormulaSample::class, 'FORMULASAMPLE'),
            'rule'         => 'PAIR',
            'name'         => 'T',
            'index'        => ++$key,
            'active'       => true,
        ]);
    }
}
