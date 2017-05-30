<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CostLubeRepositoryInterface;
use App\Cost;
use DB;
use App\Common\DBHelper;

class CostLubeEloquentRepository extends EloquentBaseRepository implements CostLubeRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Cost::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->allActiveQuery('costs.active')
            ->where('costs.type', 'LUBE')
            ->leftJoin('fuels', 'fuels.id', '=', 'costs.fuel_id')
            ->leftJoin('trucks', 'trucks.id', '=', 'costs.truck_id')
            ->select('costs.*'
                , 'fuels.price as fuel_price'
                , DB::raw(DBHelper::getWithCurrencyFormat('fuels.price', 'fc_fuel_price'))
                , DB::raw(DBHelper::getWithCurrencyFormat('costs.after_vat', 'fc_after_vat'))
                , DB::raw(DBHelper::getWithDateTimeFormat('costs.refuel_date', 'fd_refuel_date'))
                , DB::raw(DBHelper::getWithAreaCodeNumberPlate('trucks.area_code', 'trucks.number_plate', 'truck_area_code_number_plate'))
            );
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('costs.id', $id);
    }
}