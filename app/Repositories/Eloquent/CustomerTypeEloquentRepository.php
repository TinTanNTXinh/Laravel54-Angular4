<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CustomerTypeRepositoryInterface;
use App\CustomerType;

class CustomerTypeEloquentRepository extends EloquentBaseRepository implements CustomerTypeRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return CustomerType::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('customer_types.id', $id);
    }
}