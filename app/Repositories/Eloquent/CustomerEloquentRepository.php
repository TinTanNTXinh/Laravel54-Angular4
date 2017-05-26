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
}