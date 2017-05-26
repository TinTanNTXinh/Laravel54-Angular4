<?php

namespace App\Repositories\Eloquent;

use App\Repositories\UserRepositoryInterface;
use App\User;

class UserEloquentRepository extends EloquentBaseRepository implements UserRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return User::class;
    }

    public function allActive()
    {
        return $this->model->whereActive(true);
    }
}