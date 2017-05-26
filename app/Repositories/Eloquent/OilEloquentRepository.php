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
}