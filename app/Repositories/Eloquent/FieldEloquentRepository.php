<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FieldRepositoryInterface;
use App\Field;

class FieldEloquentRepository extends EloquentBaseRepository implements FieldRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Field::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('fields.id', $id);
    }
}