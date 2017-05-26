<?php

namespace App\Repositories\Eloquent;

use App\Repositories\LubeRepositoryInterface;
use App\Fuel;

class LubeEloquentRepository extends EloquentBaseRepository implements LubeRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Fuel::class;
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