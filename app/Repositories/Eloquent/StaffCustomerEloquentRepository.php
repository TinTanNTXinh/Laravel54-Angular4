<?php

namespace App\Repositories\Eloquent;

use App\Repositories\StaffCustomerRepositoryInterface;
use App\StaffCustomer;

class StaffCustomerEloquentRepository extends EloquentBaseRepository implements StaffCustomerRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return StaffCustomer::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('staff_customers.id', $id);
    }
}