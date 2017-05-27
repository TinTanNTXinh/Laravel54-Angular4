<?php

namespace App\Repositories\Eloquent;

use App\Repositories\DriverRepositoryInterface;
use App\Driver;

class DriverEloquentRepository extends EloquentBaseRepository implements DriverRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Driver::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('drivers.id', $id);
    }
}