<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FormulaRepositoryInterface;
use App\Formula;
use App\Postage;

class FormulaEloquentRepository extends EloquentBaseRepository implements FormulaRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Formula::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('formulas.id', $id);
    }

    public function readByCustomerId($customer_id, $transport_date = null)
    {
        if(!isset($transport_date))
            $transport_date = date('Y-m-d') . ' 00:00:00';

        $postage = Postage::whereActive(true)
            ->where('customer_id', $customer_id)
            ->where('apply_date', '<', $transport_date)
            ->orderBy('apply_date', 'desc')
            ->first();

        if(!$postage) return [];

        $formulas = $this->allActiveQuery()
            ->where('postage_id', $postage->id)
            ->get();

        return $formulas;
    }

    public function deleteByPostageId($postage_id)
    {
        return $this->allActiveQuery()
            ->where('postage_id', $postage_id)
            ->delete();
    }
}