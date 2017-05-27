<?php

namespace App\Repositories\Eloquent;

use App\Repositories\OilRepositoryInterface;
use App\Fuel;

class OilEloquentRepository extends EloquentBaseRepository implements OilRepositoryInterface
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
        return $this->model->whereActive(true)
            ->where('type', 'OIL');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('fuels.id', $id);
    }
}