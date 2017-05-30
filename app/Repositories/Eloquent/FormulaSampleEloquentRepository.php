<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FormulaSampleRepositoryInterface;
use App\FormulaSample;

class FormulaSampleEloquentRepository extends EloquentBaseRepository implements FormulaSampleRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return FormulaSample::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('formula_samples.id', $id);
    }
}