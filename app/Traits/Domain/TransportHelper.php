<?php

namespace App\Traits\Domain;

use App\Transport;

trait TransportHelper
{
    public function readAllTransport()
    {
        $skeleton = Transport::where('transports.active', true)
//            ->where('transports.type2', '!=', 'CUSTOMER-HD-FULL')
//            ->orWhere('transports.type2', '!=', 'CUSTOMER-PTT-FULL')
//            ->orWhere('transports.type3', '!=', 'GARAGE-PTT-FULL')
            ->leftJoin('products', 'products.id', '=', 'transports.product_id')
            ->leftJoin('customers', 'customers.id', '=', 'transports.customer_id')
            ->leftJoin('trucks', 'trucks.id', '=', 'transports.truck_id')
            ->leftJoin('truck_types', 'truck_types.id', '=', 'trucks.truck_type_id')
            ->leftJoin('postages', 'postages.id', '=', 'transports.postage_id')
            ->leftJoin('users as creators', 'creators.id', '=', 'transports.created_by')
            ->leftJoin('users as updators', 'updators.id', '=', 'transports.updated_by')
            ->orderBy('transports.transport_date', 'desc')
            ->select('transports.*',
                'products.name as product_name',
                'customers.fullname as customer_fullname',
                'trucks.area_code as truck_area_code',
                'trucks.number_plate as truck_number_plate',
                'creators.fullname as creator_fullname',
                'updators.fullname as updator_fullname',
                'truck_types.name as truck_type_name',
                'postages.unit_price as postage_unit_price'
            );

        return [
            'skeleton' => $skeleton
        ];
    }
}