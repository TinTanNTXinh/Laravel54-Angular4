<?php

use Illuminate\Database\Seeder;
use App\Traits\Common\DBHelper;

class FormulasTableSeeder extends Seeder
{
    use DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # FORMOSA #
        $FORMOSA_VALUE = ['Đồng Nai', 'Tp HCM', 'Nha Trang'];
        foreach ($FORMOSA_VALUE as $key => $value) {
            \App\Formula::create([
                'code'         => $this->generateCode(\App\Formula::class, 'FORMULA'),
                'rule'         => 'SINGLE',
                'name'         => 'Tỉnh',
                'value1'       => $value,
                'value2'       => null,
                'index'        => ++$key,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true,
                'postage_id'   => $key,
            ]);
        }

        # A CHAU #
        $ACHAU_VALUE1 = ['An Giang', 'TX Châu Đốc', '310', 'M'];
        $ACHAU_NAME   = ['Tỉnh', 'Địa chỉ giao hàng', 'Cự ly', 'Mã SP'];

        foreach ($ACHAU_VALUE1 as $key => $value) {
            \App\Formula::create([
                'code'         => $this->generateCode(\App\Formula::class, 'FORMULA'),
                'rule'         => 'SINGLE',
                'name'         => $ACHAU_NAME[$key],
                'value1'       => $value,
                'value2'       => null,
                'index'        => ++$key,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true,
                'postage_id'   => 4,
            ]);
        }
    }
}
