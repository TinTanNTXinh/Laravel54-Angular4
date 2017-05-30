<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FieldRepositoryInterface;
use App\Field;

class FieldEloquentRepository extends EloquentBaseRepository implements FieldRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Field::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('fields.id', $id);
    }
}