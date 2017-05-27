<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TruckRepositoryInterface;
use App\Truck;

class TruckEloquentRepository extends EloquentBaseRepository implements TruckRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Truck::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('trucks.id', $id);
    }
}