<?php

namespace App\Repositories\Eloquent;

use App\Repositories\VoucherRepositoryInterface;
use App\Voucher;

class VoucherEloquentRepository extends EloquentBaseRepository implements VoucherRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Voucher::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('vouchers.id', $id);
    }
}