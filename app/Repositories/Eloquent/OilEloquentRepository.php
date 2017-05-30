<?php

namespace App\Repositories\Eloquent;

use App\Repositories\OilRepositoryInterface;
use App\Fuel;
use DB;
use App\Common\DBHelper;

class OilEloquentRepository extends EloquentBaseRepository implements OilRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Fuel::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->where('type', 'OIL')
            ->select('fuels.*'
                , DB::raw(DBHelper::getWithCurrencyFormat('fuels.price', 'fc_price'))
                , DB::raw(DBHelper::getWithDateTimeFormat('fuels.apply_date', 'fd_apply_date'))
            )
            ->orderBy('apply_date', 'desc');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('fuels.id', $id);
    }
}