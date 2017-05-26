<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class DriversTableSeeder extends Seeder
{
    use DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array_name = [
            'Đặng Hùng Lãm',
            'Nguyễn Phước Hòa',
            'Nguyễn Văn Nghĩa',
            'Phạm Văn Lập'
        ];

        foreach ($array_name as $key => $item) {
            \App\Driver::create([
                'code'     => $this->generateCode(\App\Driver::class, 'DRIVER'),
                'fullname' => $item,
                'phone'    => '0987654321',
                'birthday' => '1994-01-05',
                'sex'      => 'Nam',
                'email'    => '',

                'dia_chi_thuong_tru'    => '652/2A Lê Quang Định',
                'dia_chi_tam_tru'       => 'Điện Biên Phủ',
                'so_chung_minh'         => random_int(100000000, 900000000),
                'ngay_cap_chung_minh'   => '2012-01-05',
                'loai_bang_lai'         => 'B2',
                'so_bang_lai'           => random_int(100000000, 900000000),
                'ngay_cap_bang_lai'     => '2013-01-05',
                'ngay_het_han_bang_lai' => '2038-01-05',

                'start_date'   => '2013-01-05',
                'finish_date'  => null,
                'note'         => '',
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true
            ]);
        }
    }
}
