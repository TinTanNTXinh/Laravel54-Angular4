<?php

namespace App\Repositories\Eloquent;

use App\Repositories\InvoiceCustomerRepositoryInterface;
use App\Invoice;

class InvoiceCustomerEloquentRepository extends EloquentBaseRepository implements InvoiceCustomerRepositoryInterface
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
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('.id', $id);
    }
}