<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserPositionRepositoryInterface;
use App\UserPosition;

class UserPositionEloquentRepository extends EloquentBaseRepository implements UserPositionRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return UserPosition::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('user_positions.id', $id);
    }
}