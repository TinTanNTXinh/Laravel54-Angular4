<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

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

        $array_name = [
            'Trần Thị Mỹ Nhi',
            'Nguyễn Đình Trường',
            'Trần Thị Thùy Trang',
            'Lê Bảo Khánh',
            'Đồng Thụy Mỹ Phương',
            'Nguyễn Thị Tường Ánh',
            'Hà Cẩm Quyên',
            'Võ Tấn Trường',
            'Lê Thị Xuân Nở',
            'Nguyễn Thế Anh',
            'Nguyễn Trần Hoàng Ngân',
            'Trần Nguyễn Thiện Lâm',
            'Nguyễn Hoàng Nam',
            'Huỳnh Tấn Đoàn',
            'Nguyễn Trung Nam'
        ];

        $array_code = [
            'tranthimynhi',
            'nguyendinhtruong',
            'tranthithuytrang',
            'lebaokhanh',
            'dongthumyphuong',
            'nguyenthituonganh',
            'hacamquyen',
            'votantruong',
            'lethixuanno',
            'nguyentheanh',
            'nguyentranhoangngan',
            'trannguyenthienlam',
            'nguyenhoangnam',
            'huynhtandoan',
            'nguyentrungnam'
        ];

        foreach($array_name as $key => $name) {
            \App\User::create([
                'code'          => $this->generateCode($class_name, $prefix),
                'fullname'      => $name,
                'username'      => $array_code[$key],
                'password'      => Hash::make('123456'),
                'address'       => '',
                'phone'         => '',
                'birthday'      => date('Y-m-d'),
                'sex'           => 'Nam',
                'email'         => '',
                'note'          => '',
                'created_by'    => 1,
                'updated_by'    => 0,
                'created_date'  => date('Y-m-d H:i:s'),
                'updated_date'  => date('Y-m-d H:i:s'),
                'active'        => true
            ]);
        }
    }
}
