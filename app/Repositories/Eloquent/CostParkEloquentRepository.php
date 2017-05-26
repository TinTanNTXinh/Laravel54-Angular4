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
}