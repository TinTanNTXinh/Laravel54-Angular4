<?php

namespace App\Repositories\Eloquent;

use App\Repositories\DriverTruckRepositoryInterface;
use App\DriverTruck;

class DriverTruckEloquentRepository extends EloquentBaseRepository implements DriverTruckRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return DriverTruck::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('driver_trucks.id', $id);
    }
}