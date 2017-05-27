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

    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->where('invoices.type2', 'like', 'GARAGE-%');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('invoices.id', $id);
    }
}