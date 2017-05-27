<?php

namespace App\Repositories\Eloquent;

use App\Repositories\GarageRepositoryInterface;
use App\Garage;

class GarageEloquentRepository extends EloquentBaseRepository implements GarageRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Garage::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('garages.id', $id);
    }
}