<?php

use Illuminate\Database\Seeder;

class UserPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_sub_position = [
            '3'  => '3',
            '4'  => '4',
            '5'  => '5',
            '6'  => ['6', '5'],
            '7'  => '7',
            '8'  => '4',
            '9'  => ['5', '8'],
            '10' => ['4', '9'],
            '11' => '4',
            '12' => '5',
            '13' => '4',
            '14' => ['4', '9'],
            '15' => '9',
            '16' => ['4', '9'],
            '17' => '9'
        ];
        foreach ($array_sub_position as $key => $sub) {
            if (is_array($sub)) {
                foreach ($sub as $value) {
                    \App\UserPosition::create([
                        'user_id'      => $key,
                        'position_id'  => $value,
                        'created_by'   => 1,
                        'updated_by'   => 0,
                        'created_date' => date('Y-m-d'),
                        'updated_date' => date('Y-m-d'),
                        'active'       => true
                    ]);
                }
            } else {
                \App\UserPosition::create([
                    'user_id'      => $key,
                    'position_id'  => $sub,
                    'created_by'   => 1,
                    'updated_by'   => 0,
                    'created_date' => date('Y-m-d'),
                    'updated_date' => date('Y-m-d'),
                    'active'       => true
                ]);
            }
        }
    }
}
