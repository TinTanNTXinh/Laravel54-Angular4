<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TransportInvoiceRepositoryInterface;
use App\TransportInvoice;

class TransportInvoiceEloquentRepository extends EloquentBaseRepository implements TransportInvoiceRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return TransportInvoice::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('transport_invoices.id', $id);
    }
}