<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class GaragesTableSeeder extends Seeder
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
            'Nhà xe cá nhân',
            'Garage Hoàng Nguyễn',
            'Carcare An Dương Vương',
            'Chevrolet Vạn Hạnh',
            'CN Cty cp XNK&DV ôtô Mặt trời mọc (Honda Cộng Hòa)',
            'CN Cty TNHH Sài Gòn ôtô',
            'Công ty Cổ Phần Ôtô Việt',
            'Công ty CP Ô tô Âu Châu (Euro Auto)',
            'Công ty Lâm Phong',
            'Công ty TNHH bảo trì sửa chữa ô tô Earth Việt Nam',
            'Công ty TNHH Hoàng Xa'
        ];

        foreach($array_name as $key => $name) {
            \App\Garage::create([
                'code'          => $this->generateCode(\App\Garage::class, 'GARAGE'),
                'name'          => $name,
                'description'   => '',
                'address'       => '70 Bis Nguyễn Văn Lượng, P.10, Gò Vấp - TP HCM',
                'contactor'     => 'Binh',
                'phone'         => '0987650650',
                'note'          => '',
                'active'        => true,
                'garage_type_id' => ($key % 2) + 1
            ]);
        }

    }
}
