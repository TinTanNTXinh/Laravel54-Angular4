<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class PositionsTableSeeder extends Seeder
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
            'Nhân viên giao nhận chứng từ',
            'Kế toán trưởng',
            'Thủ quỷ',
            'Điều vận',
            'Đối chiếu bảng kê',
            'Nhận chứng từ',
            'Kế toán',
            'Chi phí xe',
            'Giao nhận'
        ];

        foreach($array_name as $key => $name){
            \App\Position::create([
            	'code'		  => $this->generateCode(\App\Position::class, 'POSITION'),
                'name'        => $array_name[$key],
                'description' => '',
                'active'      => true
            ]);
        }
    }
}
