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

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('.id', $id);
    }
}