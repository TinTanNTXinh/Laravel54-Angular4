<?php

use Illuminate\Database\Seeder;

class TransportsTableSeeder extends Seeder
{
    use \App\Traits\DBHelper;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* FORMOSA */
        \App\Transport::create([
            'code'             => $this->generateCode(\App\Transport::class, 'TRANSPORT'),
            'transport_date'   => date('Y-m-d h:i:s'),
            'type'             => 'Bình thường',
            'quantum_product'  => 100,
            'revenue'          => 14900000,
            'profit'           => 13455000,
            'receive'          => 500000,
            'delivery'         => 1445000,
            'carrying'         => 50000,
            'parking'          => 100000,
            'fine'             => 200000,
            'phi_tang_bo'      => 50000,
            'add_score'        => 50000,
            'delivery_real'    => 1445000,
            'carrying_real'    => 50000,
            'parking_real'     => 100000,
            'fine_real'        => 200000,
            'phi_tang_bo_real' => 50000,
            'add_score_real'   => 50000,

            'voucher_number'             => 'A911',
            'quantum_product_on_voucher' => 100,
            'receiver'                   => 'Tâm',

            'note'         => '',
            'created_by'   => 1,
            'updated_by'   => 0,
            'created_date' => date('Y-m-d'),
            'updated_date' => null,
            'active'       => true,
            'truck_id'     => 1,
            'product_id'   => 1,
            'customer_id'  => 1,
            'postage_id'   => 1
        ]);

        \App\Transport::create([
            'code'             => $this->generateCode(\App\Transport::class, 'TRANSPORT'),
            'transport_date'   => date('Y-m-d h:i:s'),
            'type'             => 'Bình thường',
            'quantum_product'  => 200,
            'revenue'          => 46910000,
            'profit'           => 42224000,
            'receive'          => 500000,
            'delivery'         => 4686000,
            'carrying'         => 0,
            'parking'          => 0,
            'fine'             => 0,
            'phi_tang_bo'      => 0,
            'add_score'        => 50000,
            'delivery_real'    => 4686000,
            'carrying_real'    => 0,
            'parking_real'     => 0,
            'fine_real'        => 0,
            'phi_tang_bo_real' => 0,
            'add_score_real'   => 50000,

            'voucher_number'             => 'A922',
            'quantum_product_on_voucher' => 200,
            'receiver'                   => 'Tâm2',

            'note'         => '',
            'created_by'   => 1,
            'updated_by'   => 0,
            'created_date' => date('Y-m-d'),
            'updated_date' => null,
            'active'       => true,
            'truck_id'     => 2,
            'product_id'   => 2,
            'customer_id'  => 1,
            'postage_id'   => 2
        ]);

        /* A Chau */
        \App\Transport::create([
            'code'             => $this->generateCode(\App\Transport::class, 'TRANSPORT'),
            'transport_date'   => date('Y-m-d h:i:s'),
            'type'             => 'Bình thường',
            'quantum_product'  => 5000,
            'revenue'          => 8015000,
            'profit'           => 7258500,
            'receive'          => 1000000,
            'delivery'         => 756500,
            'carrying'         => 100000,
            'parking'          => 100000,
            'fine'             => 100000,
            'phi_tang_bo'      => 100000,
            'add_score'        => 50000,
            'delivery_real'    => 756500,
            'carrying_real'    => 100000,
            'parking_real'     => 100000,
            'fine_real'        => 100000,
            'phi_tang_bo_real' => 100000,
            'add_score_real'   => 50000,

            'voucher_number'             => 'A933',
            'quantum_product_on_voucher' => 5000,
            'receiver'                   => 'Tâm3',

            'note'         => '',
            'created_by'   => 1,
            'updated_by'   => 0,
            'created_date' => date('Y-m-d'),
            'updated_date' => null,
            'active'       => true,
            'truck_id'     => 3,
            'product_id'   => 6,
            'customer_id'  => 2,
            'postage_id'   => 4
        ]);
    }
}
