<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FormulaSampleRepositoryInterface;
use App\FormulaSample;

class FormulaSampleEloquentRepository extends EloquentBaseRepository implements FormulaSampleRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return FormulaSample::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('formula_samples.id', $id);
    }
}