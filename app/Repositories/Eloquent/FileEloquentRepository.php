<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FileRepositoryInterface;
use App\File;

class FileEloquentRepository extends EloquentBaseRepository implements FileRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return File::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('files.id', $id);
    }
}