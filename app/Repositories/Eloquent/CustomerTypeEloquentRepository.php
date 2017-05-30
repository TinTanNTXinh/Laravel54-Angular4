<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CustomerTypeRepositoryInterface;
use App\CustomerType;

class CustomerTypeEloquentRepository extends EloquentBaseRepository implements CustomerTypeRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return CustomerType::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('customer_types.id', $id);
    }
}