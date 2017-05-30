<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PositionRepositoryInterface;
use App\Position;

class PositionEloquentRepository extends EloquentBaseRepository implements PositionRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Position::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('positions.id', $id);
    }
}