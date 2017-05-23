<?php

use Illuminate\Database\Seeder;

class TransportVouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* FORMOSA */
        $voucher_ids = [1, 2, 3, 4];
        foreach($voucher_ids as $key => $voucher_id) {
            \App\TransportVoucher::create([
                'voucher_id'   => $voucher_id,
                'transport_id' => 1,
                'quantum'      => 2,
                'created_by'   => 1,
                'updated_by'   => 0,
                'created_date' => date('Y-m-d'),
                'updated_date' => null,
                'active'       => true
            ]);
        }
    }
}
