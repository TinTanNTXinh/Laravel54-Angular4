<?php

namespace App\Repositories\Eloquent;

use App\Repositories\ProductTypeRepositoryInterface;
use App\ProductType;

class ProductTypeEloquentRepository extends EloquentBaseRepository implements ProductTypeRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return ProductType::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('product_types.id', $id);
    }
}