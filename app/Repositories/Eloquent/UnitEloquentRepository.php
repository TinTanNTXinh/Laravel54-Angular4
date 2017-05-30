<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UnitRepositoryInterface;
use App\Unit;

class UnitEloquentRepository extends EloquentBaseRepository implements UnitRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Unit::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('units.id', $id);
    }
}