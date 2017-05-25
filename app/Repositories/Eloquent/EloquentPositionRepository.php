<?php

namespace App\Repositories\Eloquent;

use App\Traits\DBHelper;
use App\Repositories\PositionRepositoryInterface;
use App\Position;
use DB;

class EloquentPositionRepository extends EloquentBaseRepository implements PositionRepositoryInterface
{
    use DBHelper;

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