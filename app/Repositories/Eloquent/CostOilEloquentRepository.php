<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CostOilRepositoryInterface;
use App\Cost;

class CostOilEloquentRepository extends EloquentBaseRepository implements CostOilRepositoryInterface
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