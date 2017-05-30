<?php

namespace App\Repositories\Eloquent;

use App\Repositories\RoleRepositoryInterface;
use App\Role;

class RoleEloquentRepository extends EloquentBaseRepository implements RoleRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Role::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true)
            ->orderBy('index');
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('roles.id', $id);
    }
}