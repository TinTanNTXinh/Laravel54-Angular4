<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FormulaRepositoryInterface;
use App\Formula;

class FormulaEloquentRepository extends EloquentBaseRepository implements FormulaRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Formula::class;
    }
}