<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FormulaRepositoryInterface;
use App\Formula;
use App\Postage;

class FormulaEloquentRepository extends EloquentBaseRepository implements FormulaRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Formula::class;
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

        $formulas = $this->model->whereActive(true)
            ->where('postage_id', $postage->id)
            ->get();

        return $formulas;
    }
}