<?php

namespace App\Repositories\Eloquent;

use App\Repositories\GroupRoleRepositoryInterface;
use App\GroupRole;

class GroupRoleEloquentRepository extends EloquentBaseRepository implements GroupRoleRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return GroupRole::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->orderBy('index');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('group_roles.id', $id);
    }
}