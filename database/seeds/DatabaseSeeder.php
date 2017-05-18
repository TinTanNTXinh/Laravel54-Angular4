<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $env = env('APP_PROD', false);
        if ($env) {
            ### DEFAULT SEED
            # Nhóm người dùng
            $this->call(GroupRolesTableSeeder::class);
            $this->call(RolesTableSeeder::class);
            $this->call(PositionsTableSeeder::class);
            $this->call(AdminsTableSeeder::class);
            $this->call(AdminRolesTableSeeder::class);
            $this->call(AdminPositionsTableSeeder::class);

            # Nhóm sản phẩm
            $this->call(UnitsTableSeeder::class);

            # Nhóm tập tin
            $this->call(AdminFilesTableSeeder::class);

            # Nhóm khách hàng
        } else {
            /*
             * ===========================================
             * */

            ### DEVELOP

        }
    }
}
