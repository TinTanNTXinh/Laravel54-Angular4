<?php

namespace App\Repositories\Eloquent;

use App\Repositories\ProductTypeRepositoryInterface;
use App\ProductType;

class ProductTypeEloquentRepository extends EloquentBaseRepository implements ProductTypeRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return ProductType::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('product_types.id', $id);
    }
}