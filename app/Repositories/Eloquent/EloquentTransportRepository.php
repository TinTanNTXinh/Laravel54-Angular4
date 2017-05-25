<?php

namespace App\Repositories\Eloquent;

use App\Traits\DBHelper;
use App\Repositories\TransportRepositoryInterface;
use App\Transport;
use DB;

class EloquentTransportRepository extends EloquentBaseRepository implements TransportRepositoryInterface
{
    use DBHelper;

    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Transport::class;
    }

    /**
     * Lấy danh sách các post đã active
     * @return object
     */
    public function allActive()
    {
        return $this->model->where('transports.active', true)
//            ->where('transports.type2', '!=', 'CUSTOMER-HD-FULL')
//            ->orWhere('transports.type2', '!=', 'CUSTOMER-PTT-FULL')
//            ->orWhere('transports.type3', '!=', 'GARAGE-PTT-FULL')
            ->leftJoin('products', 'products.id', '=', 'transports.product_id')
            ->leftJoin('customers', 'customers.id', '=', 'transports.customer_id')
            ->leftJoin('trucks', 'trucks.id', '=', 'transports.truck_id')
            ->leftJoin('truck_types', 'truck_types.id', '=', 'trucks.truck_type_id')
            ->leftJoin('postages', 'postages.id', '=', 'transports.postage_id')
            ->leftJoin('units', 'units.id', '=', 'postages.unit_id')
            ->leftJoin('users as creators', 'creators.id', '=', 'transports.created_by')
            ->leftJoin('users as updators', 'updators.id', '=', 'transports.updated_by')
            ->orderBy('transports.transport_date', 'desc')
            ->select('transports.*'
                , 'products.name as product_name'
                , 'customers.fullname as customer_fullname'
                , 'trucks.area_code as truck_area_code'
                , 'trucks.number_plate as truck_number_plate'
                , 'creators.fullname as creator_fullname'
                , 'updators.fullname as updator_fullname'
                , 'truck_types.name as truck_type_name'
                , 'postages.unit_price as postage_unit_price'
                , 'units.name as unit_name'
                , DB::raw($this->getWithCurrencyFormat('transports.receive', 'fc_receive'))
                , DB::raw($this->getWithCurrencyFormat('transports.carrying', 'fc_carrying'))
                , DB::raw($this->getWithCurrencyFormat('transports.parking', 'fc_parking'))
                , DB::raw($this->getWithCurrencyFormat('transports.fine', 'fc_fine'))
                , DB::raw($this->getWithCurrencyFormat('transports.phi_tang_bo', 'fc_phi_tang_bo'))
                , DB::raw($this->getWithCurrencyFormat('transports.add_score', 'fc_add_score'))
                , DB::raw($this->getWithDateTimeFormat('transports.transport_date', 'fd_transport_date'))
            );
    }
}