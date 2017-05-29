<?php

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleLength = \App\Role::all()->count();
        //admin
        for ($i = 1; $i <= $roleLength; $i++) {
            \App\UserRole::create([
                'user_id'      => 1,
                'role_id'      => $i,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => null,
                'active'       => true
            ]);
        }

        //vsys
        for ($i = 1; $i <= $roleLength; $i++) {
            \App\UserRole::create([
                'user_id'      => 2,
                'role_id'      => $i,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => null,
                'active'       => true
            ]);
        }
    }
}
