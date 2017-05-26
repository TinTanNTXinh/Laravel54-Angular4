<?php

namespace App\Repositories\Eloquent;

use App\Repositories\CostLubeRepositoryInterface;
use App\Cost;

class CostLubeEloquentRepository extends EloquentBaseRepository implements CostLubeRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Cost::class;
    }
}