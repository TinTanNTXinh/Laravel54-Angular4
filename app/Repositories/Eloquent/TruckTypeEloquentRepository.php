<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TruckTypeRepositoryInterface;
use App\TruckType;

class TruckTypeEloquentRepository extends EloquentBaseRepository implements TruckTypeRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return TruckType::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('truck_types.id', $id);
    }
}