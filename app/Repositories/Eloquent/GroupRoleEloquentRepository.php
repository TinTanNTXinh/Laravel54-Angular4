<?php

namespace App\Repositories\Eloquent;

use App\Repositories\GroupRoleRepositoryInterface;
use App\GroupRole;

class GroupRoleEloquentRepository extends EloquentBaseRepository implements GroupRoleRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return GroupRole::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
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