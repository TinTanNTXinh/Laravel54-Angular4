<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TruckTypeRepositoryInterface;
use App\TruckType;

class TruckTypeEloquentRepository extends EloquentBaseRepository implements TruckTypeRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return TruckType::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('truck_types.id', $id);
    }
}