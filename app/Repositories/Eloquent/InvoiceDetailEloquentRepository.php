<?php

namespace App\Repositories\Eloquent;

use App\Repositories\InvoiceDetailRepositoryInterface;
use App\InvoiceDetail;

class InvoiceDetailEloquentRepository extends EloquentBaseRepository implements InvoiceDetailRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return InvoiceDetail::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('invoice_details.id', $id);
    }
}