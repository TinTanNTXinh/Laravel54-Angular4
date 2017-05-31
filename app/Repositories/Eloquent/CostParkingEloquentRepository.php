<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CostParkingRepositoryInterface;
use App\Cost;

class CostParkingEloquentRepository extends EloquentBaseRepository implements CostParkingRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Cost::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->where('costs.type', 'PARK');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('costs.id', $id);
    }
}