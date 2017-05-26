<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PositionRepositoryInterface;
use App\Position;

class PositionEloquentRepository extends EloquentBaseRepository implements PositionRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Position::class;
    }
}