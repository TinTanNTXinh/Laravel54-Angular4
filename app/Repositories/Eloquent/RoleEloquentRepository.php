<?php

namespace App\Repositories\Eloquent;

use App\Repositories\RoleRepositoryInterface;
use App\Role;

class RoleEloquentRepository extends EloquentBaseRepository implements RoleRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Role::class;
    }
}