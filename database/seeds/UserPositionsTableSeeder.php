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
            3  => 1,
            4  => 2,
            5  => 3,
            6  => 4,
            7  => 5,
            8  => [6, 5],
            9  => 7,
            10 => 4,
            11 => [5, 8],
            12 => [4, 9],
            13 => 4,
            14 => 5,
            15 => 4,
            16 => [4, 9],
            17 => 9
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
