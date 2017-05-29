<?php

use Illuminate\Database\Seeder;

class AdminPositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position_ids = \App\Position::all()->pluck('id')->toArray();
        $array_sub_position = [
            1  => $position_ids,
            2  => $position_ids
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
                        'updated_date' => null,
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
                    'updated_date' => null,
                    'active'       => true
                ]);
            }
        }
    }
}
