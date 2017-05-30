<?php

namespace App\Repositories\Eloquent;

use App\Common\DBHelper;
use App\Repositories\TruckRepositoryInterface;
use App\Truck;
use DB;

class TruckEloquentRepository extends EloquentBaseRepository implements TruckRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Truck::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->allActiveQuery('trucks.active')
            ->leftJoin('garages', 'garages.id', '=', 'trucks.garage_id')
            ->leftJoin('truck_types', 'truck_types.id', '=', 'trucks.truck_type_id')
            ->select('trucks.*'
                , 'truck_types.name as truck_type_name'
                , 'truck_types.weight as truck_type_weight'
                , 'garages.name as garage_name'
                , DB::raw(DBHelper::getWithAreaCodeNumberPlate('trucks.area_code', 'trucks.number_plate', 'area_code_number_plate'))
            );
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('trucks.id', $id);
    }
}