<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

class AdminsTableSeeder extends Seeder
{
    use DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class_name = \App\User::class;
        $prefix = 'ADMIN';

        # USER SYSTEM
        // 1
        \App\User::create([
            'code'          => $this->generateCode($class_name, $prefix),
            'fullname'      => 'Admin',
            'username'      => 'admin',
            'password'      => Hash::make('123456'), //t1nt@n50ft.comA1
            'address'       => 'admin',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => 'admin@vsys.com',
            'note'          => 'admin',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);
        // 2
        \App\User::create([
            'code'          => $this->generateCode($class_name, $prefix),
            'fullname'      => 'Super Admin',
            'username'      => 'superadmin',
            'password'      => Hash::make('123456'),
            'address'       => 'vsys',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => 'vsys@vsys.com',
            'note'          => 'vsys',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);
    }
}
