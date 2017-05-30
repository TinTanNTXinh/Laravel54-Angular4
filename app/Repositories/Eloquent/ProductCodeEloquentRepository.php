<?php

namespace App\Repositories\Eloquent;

use App\Repositories\ProductCodeRepositoryInterface;
use App\ProductCode;

class ProductCodeEloquentRepository extends EloquentBaseRepository implements ProductCodeRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return ProductCode::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('product_codes.id', $id);
    }
}