<?php

use Illuminate\Database\Seeder;

class UserRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * IOCenter 1
         * */

        $role_admin_sup = [15, 12, 6];
        $role_nvnhap_sup = 17; //ReportStaffInput
        $role_admin_dis = [16, 12, 6];
        $role_nvxuat_dis = [16]; //ReportDistributor

        // Thuoc Viet Admin
        foreach($role_admin_sup as $role_id) {
            \App\UserRole::create([
                'user_id'      => 4,
                'role_id'      => $role_id,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => date('Y-m-d H:i:s'),
                'active'       => true
            ]);
        }

        // Thuoc Viet Input
        \App\UserRole::create([
            'user_id'      => 5,
            'role_id'      => $role_nvnhap_sup,
            'created_by'   => 1,
            'updated_by'   => 0,
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),
            'active'       => true
        ]);

        // Thuoc Viet Input
        \App\UserRole::create([
            'user_id'      => 6,
            'role_id'      => $role_nvnhap_sup,
            'created_by'   => 1,
            'updated_by'   => 0,
            'created_date' => date('Y-m-d H:i:s'),
            'updated_date' => date('Y-m-d H:i:s'),
            'active'       => true
        ]);

        // Nhan Ai Admin 1
        foreach($role_admin_dis as $role_id) {
            \App\UserRole::create([
                'user_id'      => 7,
                'role_id'      => $role_id,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => date('Y-m-d H:i:s'),
                'active'       => true
            ]);
        }

        // Nhan Ai Admin 2
        foreach($role_admin_dis as $role_id) {
            \App\UserRole::create([
                'user_id'      => 8,
                'role_id'      => $role_id,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'updated_date' => date('Y-m-d H:i:s'),
                'active'       => true
            ]);
        }
    }
}
