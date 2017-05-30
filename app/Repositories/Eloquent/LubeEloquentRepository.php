<?php

namespace App\Repositories\Eloquent;

use App\Repositories\LubeRepositoryInterface;
use App\Fuel;

class LubeEloquentRepository extends EloquentBaseRepository implements LubeRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Fuel::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->where('type', 'LUBE');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('fuels.id', $id);
    }
}