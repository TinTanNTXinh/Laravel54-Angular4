<?php

namespace App\Repositories\Eloquent;

use App\Repositories\GarageRepositoryInterface;
use App\Garage;

class GarageEloquentRepository extends EloquentBaseRepository implements GarageRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Garage::class;
    }
}