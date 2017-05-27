<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UnitPriceParkRepositoryInterface;
use App\UnitPricePark;

class UnitPriceParkEloquentRepository extends EloquentBaseRepository implements UnitPriceParkRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return UnitPricePark::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('unit_price_parks.id', $id);
    }
}