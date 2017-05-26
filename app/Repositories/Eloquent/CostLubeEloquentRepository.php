<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CostLubeRepositoryInterface;
use App\Cost;

class CostLubeEloquentRepository extends EloquentBaseRepository implements CostLubeRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Cost::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->where('costs.type', 'LUBE');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('costs.id', $id);
    }
}