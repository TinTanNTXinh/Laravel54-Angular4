<?php

namespace App\Repositories\Eloquent;

use App\Repositories\DriverTruckRepositoryInterface;
use App\DriverTruck;

class DriverTruckEloquentRepository extends EloquentBaseRepository implements DriverTruckRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return DriverTruck::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('driver_trucks.id', $id);
    }
}