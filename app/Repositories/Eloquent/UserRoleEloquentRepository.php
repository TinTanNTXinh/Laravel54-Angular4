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
}