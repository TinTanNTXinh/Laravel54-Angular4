<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PostageRepositoryInterface;
use App\Postage;
use DB;
use App\Common\DBHelper;
use App\Common\DateTimeHelper;

class PostageEloquentRepository extends EloquentBaseRepository implements PostageRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Postage::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->where('postages.active', true)
            ->leftJoin('units', 'units.id', '=', 'postages.unit_id')
            ->select('postages.*'
                , 'units.name as unit_name'
                , DB::raw(DBHelper::getWithCurrencyFormat('postages.unit_price', 'fc_unit_price'))
                , DB::raw(DBHelper::getWithDateTimeFormat('postages.apply_date', 'fd_apply_date'))
            )
            ->orderBy('postages.apply_date', 'desc');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('postages.id', $id);
    }

    public function readByCustomerId($customer_id)
    {
        return $this->allSkeleton()
            ->where('customer_id', $customer_id)
            ->get();
    }

    public function findByCustomerIdAndTransportDate($customer_id, $transport_date = null)
    {
        if (!isset($transport_date))
            $transport_date = DateTimeHelper::addTimeForDate(date('Y-m-d'), 'max');

        $postage = $this->allActiveQuery()
            ->where('customer_id', $customer_id)
            ->where('apply_date', '<=', $transport_date)
            ->orderBy('apply_date', 'desc')
            ->first();

        return $postage;
    }

}