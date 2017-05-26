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
}