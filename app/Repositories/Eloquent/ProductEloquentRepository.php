<?php

namespace App\Repositories\Eloquent;

use App\Repositories\ProductRepositoryInterface;
use App\Product;

class ProductEloquentRepository extends EloquentBaseRepository implements ProductRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Product::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('products.id', $id);
    }
}