<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TruckRepositoryInterface;
use App\Truck;

class TruckEloquentRepository extends EloquentBaseRepository implements TruckRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Truck::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('trucks.id', $id);
    }
}