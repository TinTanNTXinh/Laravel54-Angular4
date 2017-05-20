<?php

namespace App\Traits;

use App\Formula;
use App\Postage;

trait FormulaHelper
{
    public function findFormulas($customer_id, $transport_date = null)
    {
        if(!isset($transport_date))
            $transport_date = date('Y-m-d') . ' 00:00:00';

        $postage = Postage::whereActive(true)
            ->where('customer_id', $customer_id)
            ->where('apply_date', '<', $transport_date)
            ->orderBy('apply_date', 'desc')
            ->first();

        $formulas = Formula::whereActive(true)
            ->where('postage_id', $postage->id)
            ->get();

        return [
            'formulas' => $formulas
        ];
    }
}