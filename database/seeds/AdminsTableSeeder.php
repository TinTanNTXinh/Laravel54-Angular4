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
            'active'        => true,
            'position_id'   => 1,
            'dis_or_sup'    => 'system',
            'dis_or_sup_id' => 0
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
            'active'        => true,
            'position_id'   => 2,
            'dis_or_sup'    => 'system',
            'dis_or_sup_id' => 0
        ]);
        // 3
        \App\User::create([
            'code'          => $this->generateCode($class_name, $prefix),
            'fullname'      => 'Khách vãng lai',
            'username'      => 'khachvanglai',
            'password'      => Hash::make('123456'),
            'address'       => null,
            'phone'         => null,
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => null,
            'note'          => null,
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => false,
            'position_id'   => 6,
            'dis_or_sup'    => 'dis',
            'dis_or_sup_id' => 0
        ]);
    }
}
