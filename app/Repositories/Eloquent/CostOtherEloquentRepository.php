<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CostOtherRepositoryInterface;
use App\Cost;

class CostOtherEloquentRepository extends EloquentBaseRepository implements CostOtherRepositoryInterface
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