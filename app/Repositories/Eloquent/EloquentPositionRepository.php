<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PositionRepositoryInterface;
use App\Position;

class EloquentPositionRepository extends EloquentBaseRepository implements PositionRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Position::class;
    }

    public function allActive()
    {
        return $this->model->whereActive(true);
    }
}