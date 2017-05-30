<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FuelCustomerRepositoryInterface;
use App\FuelCustomer;

class FuelCustomerEloquentRepository extends EloquentBaseRepository implements FuelCustomerRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return FuelCustomer::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('fuel_customers.id', $id);
    }
}