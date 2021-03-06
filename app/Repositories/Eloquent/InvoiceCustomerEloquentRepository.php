<?php

namespace App\Repositories\Eloquent;

use App\Repositories\InvoiceCustomerRepositoryInterface;
use App\Invoice;

class InvoiceCustomerEloquentRepository extends EloquentBaseRepository implements InvoiceCustomerRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Invoice::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->where('invoices.type2', 'like', 'CUSTOMER-%');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('invoices.id', $id);
    }
}