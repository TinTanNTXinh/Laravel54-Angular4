<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UnitRepositoryInterface;
use App\Unit;

class UnitEloquentRepository extends EloquentBaseRepository implements UnitRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Unit::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('units.id', $id);
    }
}