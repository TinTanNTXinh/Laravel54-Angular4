<?php

use Illuminate\Database\Seeder;

class StaffCustomersTableSeeder extends Seeder
{
    use \App\Traits\Common\DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_name = [
            'Hồ Văn Khởi',
            'Lưu Hoàng Kha',
            'Phạm Hữu Dư',
            'Nguyễn Hoàng Phúc'
        ];

        foreach ($array_name as $key => $value) {
            \App\StaffCustomer::create([
                'code'         => $this->generateCode(\App\StaffCustomer::class, 'STAFFCUSTOMER'),
                'fullname'     => $value,
                'address'      => '',
                'phone'        => '0987655321',
                'birthday'     => '1990-01-03',
                'sex'          => 'Nam',
                'email'        => 'myemail@email.com',
                'position'     => 'Kế toán',
                'active'       => true,
                'customer_id'  => ++$key
            ]);
        }
    }
}
