<?php

namespace App\Repositories\Eloquent;

use App\Repositories\InvoiceGarageRepositoryInterface;
use App\Invoice;

class InvoiceGarageEloquentRepository extends EloquentBaseRepository implements InvoiceGarageRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Invoice::class;
    }
}