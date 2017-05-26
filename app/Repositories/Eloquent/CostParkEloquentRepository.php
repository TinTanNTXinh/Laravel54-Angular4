<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CostParkRepositoryInterface;
use App\Cost;

class CostParkEloquentRepository extends EloquentBaseRepository implements CostParkRepositoryInterface
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
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('.id', $id);
    }
}