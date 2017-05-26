<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TruckRepositoryInterface;
use App\Truck;

class TruckEloquentRepository extends EloquentBaseRepository implements TruckRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Truck::class;
    }
}