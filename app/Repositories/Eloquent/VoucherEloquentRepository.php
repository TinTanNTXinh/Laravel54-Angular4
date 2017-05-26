<?php

namespace App\Repositories\Eloquent;

use App\Repositories\VoucherRepositoryInterface;
use App\Voucher;

class VoucherEloquentRepository extends EloquentBaseRepository implements VoucherRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Voucher::class;
    }
}