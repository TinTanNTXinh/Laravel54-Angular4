<?php

use Illuminate\Database\Seeder;

class TransportFormulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* FORMOSA */
        $FORMOSA_VALUE = ['Đồng Nai', 'Tp HCM'];
        foreach($FORMOSA_VALUE as $key => $value) {
            \App\TransportFormula::create([
                'rule'         => 'S',
                'name'         => 'Tỉnh',
                'value'        => $value,
                'from_place'   => null,
                'to_place'     => null,
                'active'       => true,
                'transport_id' => $key
            ]);
        }

        /* A Chau */
        $ACHAU_VALUE1 = ['An Giang', 'TX Châu Đốc', '310', 'M'];
        $ACHAU_NAME = ['Tỉnh', 'Địa chỉ giao hàng', 'Cự ly', 'Mã SP'];
        foreach ($ACHAU_VALUE1 as $key => $value) {
            \App\TransportFormula::create([
                'rule'         => 'S',
                'name'         => $ACHAU_NAME[$key],
                'value'        => $value,
                'from_place'   => null,
                'to_place'     => null,
                'active'       => true,
                'transport_id' => 3
            ]);
        }
    }
}
