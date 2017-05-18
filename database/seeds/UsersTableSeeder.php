<?php

use Illuminate\Database\Seeder;
use App\Traits\DBHelper;

class UsersTableSeeder extends Seeder
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
        $prefix = 'USER';

        /*
         * IOCenter 1
         * */

        # USER SUPPLIER
        // Quan tri vien
        // 4
        \App\User::create([
            'code'          => $this->generateCode($class_name, $prefix),
            'fullname'      => 'Khách hàng 1',
            'username'      => 'khachhang1',
            'password'      => Hash::make('123456'),
            'address'       => 'Thuốc Việt Admin',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => 'thuocvietadmin@vsys.com',
            'note'          => 'thuocvietadmin',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);
        // NV Nhap hang 1
        // 5
        \App\User::create([
            'code'          => $this->generateCode($class_name, $prefix),
            'fullname'      => 'NV Nhập xuất 1',
            'username'      => 'nvnhapxuat1',
            'password'      => Hash::make('123456'),
            'address'       => 'Thuốc Việt Input',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => 'thuocvietinput@vsys.com',
            'note'          => 'thuocvietinput',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);
        // NV Nhap hang 2
        // 6
        \App\User::create([
            'code'          => $this->generateCode($class_name, $prefix),
            'fullname'      => 'NV Nhập xuất 2',
            'username'      => 'nvnhapxuat2',
            'password'      => Hash::make('123456'),
            'address'       => 'Thuốc Việt Input',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => 'thuocvietinput@vsys.com',
            'note'          => 'thuocvietinput',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);

        # USER DISTRIBUTOR
        // Quan tri vien
        // 7
        \App\User::create([
            'code'          => $this->generateCode($class_name, $prefix),
            'fullname'      => 'Đại lý 1',
            'username'      => 'daily1',
            'password'      => Hash::make('123456'),
            'address'       => 'Nhân Ái Admin',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => 'nhanaiadmin@vsys.com',
            'note'          => 'nhanaiadmin',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);
        // NV xuat hang 1
        // 8
        \App\User::create([
            'code'          => $this->generateCode($class_name, $prefix),
            'fullname'      => 'Đại lý 2',
            'username'      => 'daily2',
            'password'      => Hash::make('123456'),
            'address'       => 'Nhân Ái Output',
            'phone'         => '0987654321',
            'birthday'      => date('Y-m-d'),
            'sex'           => 'Nam',
            'email'         => 'nhanaioutput@vsys.com',
            'note'          => 'nhanaioutput',
            'created_by'    => 1,
            'updated_by'    => 1,
            'created_date'  => date('Y-m-d H:i:s'),
            'updated_date'  => date('Y-m-d H:i:s'),
            'active'        => true
        ]);
    }
}
