<?php

namespace App\Repositories\Eloquent;

use App\Repositories\DriverRepositoryInterface;
use App\Driver;
use DB;
use App\Common\DBHelper;

class DriverEloquentRepository extends EloquentBaseRepository implements DriverRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Driver::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->select('drivers.*'
                , DB::raw(DBHelper::getWithDateFormat('drivers.birthday', 'fd_birthday'))
                , DB::raw(DBHelper::getWithDateFormat('drivers.ngay_cap_chung_minh', 'fd_ngay_cap_chung_minh'))
                , DB::raw(DBHelper::getWithDateFormat('drivers.ngay_cap_bang_lai', 'fd_ngay_cap_bang_lai'))
                , DB::raw(DBHelper::getWithDateFormat('drivers.ngay_het_han_bang_lai', 'fd_ngay_het_han_bang_lai'))
                , DB::raw(DBHelper::getWithDateFormat('drivers.start_date', 'fd_start_date'))
                , DB::raw(DBHelper::getWithDateFormat('drivers.finish_date', 'fd_finish_date'))
            );
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('drivers.id', $id);
    }
}