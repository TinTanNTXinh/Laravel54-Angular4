<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserRoleRepositoryInterface;
use App\UserRole;

class UserRoleEloquentRepository extends EloquentBaseRepository implements UserRoleRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return UserRole::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('user_roles.id', $id);
    }

    public function readByUserId($user_id)
    {
        return $this->model->whereActive(true)
            ->where('user_id', $user_id)
            ->get();
    }

    public function deleteByUserId($user_id)
    {
        return $this->model->whereActive(true)
            ->where('user_id', $user_id)
            ->delete();
    }

    public function deactivateByUserId($user_id)
    {
        return $this->model->whereActive(true)
            ->where('user_id', $user_id)
            ->update(['active' => false]);
    }
}