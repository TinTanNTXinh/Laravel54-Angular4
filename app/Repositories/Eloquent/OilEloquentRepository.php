<?php

namespace App\Repositories\Eloquent;

use App\Repositories\OilRepositoryInterface;
use App\Fuel;
use DB;
use App\Common\DBHelper;
use App\Common\DateTimeHelper;

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
        return $this->allActiveQuery()
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

    public function findByApplyDate($i_apply_date = null)
    {
        if (!isset($i_apply_date))
            $i_apply_date = DateTimeHelper::addTimeForDate(date('Y-m-d'), 'max');

        $oil = $this->allActiveQuery()
            ->where('type', 'OIL')
            ->where('apply_date', '<=', $i_apply_date)
            ->latest('apply_date')
            ->first();

        return $oil;
    }
}