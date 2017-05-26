<?php

namespace App\Repositories\Eloquent;

use App\Repositories\ProductRepositoryInterface;
use App\Product;

class ProductEloquentRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Product::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('.id', $id);
    }
}