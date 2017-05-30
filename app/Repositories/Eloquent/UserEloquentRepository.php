<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserRepositoryInterface;
use App\User;

class UserEloquentRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return User::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('users.id', $id);
    }
}