<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserPositionRepositoryInterface;
use App\UserPosition;

class UserPositionEloquentRepository extends EloquentBaseRepository implements UserPositionRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return UserPosition::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('user_positions.id', $id);
    }

    public function readByUserId($user_id)
    {
        return $this->allActiveQuery()
            ->where('user_id', $user_id)
            ->get();
    }

    public function deleteByUserId($user_id)
    {
        return $this->allActiveQuery()
            ->where('user_id', $user_id)
            ->delete();
    }

    public function deactivateByUserId($user_id)
    {
        return $this->allActiveQuery()
            ->where('user_id', $user_id)
            ->update(['active' => false]);
    }
}