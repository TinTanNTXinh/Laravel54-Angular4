<?php

namespace App\Repositories\Eloquent;

use App\Repositories\GarageTypeRepositoryInterface;
use App\GarageType;

class GarageTypeEloquentRepository extends EloquentBaseRepository implements GarageTypeRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return GarageType::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('garage_types.id', $id);
    }
}