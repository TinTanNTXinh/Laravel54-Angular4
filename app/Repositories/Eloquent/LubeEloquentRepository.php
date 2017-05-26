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
}