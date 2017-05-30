<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CostParkRepositoryInterface;
use App\Cost;

class CostParkEloquentRepository extends EloquentBaseRepository implements CostParkRepositoryInterface
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