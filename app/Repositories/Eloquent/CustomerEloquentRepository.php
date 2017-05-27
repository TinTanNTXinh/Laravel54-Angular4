<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CustomerRepositoryInterface;
use App\Customer;

class CustomerEloquentRepository extends EloquentBaseRepository implements CustomerRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Customer::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('customers.id', $id);
    }
}