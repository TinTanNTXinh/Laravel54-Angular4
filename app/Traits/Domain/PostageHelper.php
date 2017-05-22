<?php

namespace App\Traits\Domain;

use App\Formula;
use App\Postage;

trait PostageHelper
{
    public function readAllPostage()
    {
        $skeleton = Postage::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }

    public function findPostage($i_formulas, $i_customer_id, $i_transport_date = null)
    {
        if(!isset($i_transport_date))
            $i_transport_date = date('Y-m-d') . ' 00:00:00';

        $postage_ids = Postage::whereActive(true)
            ->where('customer_id', $i_customer_id)
            ->where('apply_date', '<', $i_transport_date)
            ->pluck('id')
            ->toArray();

        $formulas = Formula::whereActive(true)
            ->whereIn('postage_id', $postage_ids)
            ->get();

        $founds = [];
        foreach ($i_formulas as $key => $i_formula) {
            $found = null;
            switch ($i_formula->rule) {
                case 'Single':
                    $found = $formulas
                        ->where('rule', $i_formula->rule)
                        ->where('name', $i_formula->name)
                        ->where('value1', $i_formula->value1)
                        ->pluck('postage_id')
                        ->toArray();
                    array_push($founds, $found);
                    break;
                case 'Range':
                case 'Oil':
                    // Convert to decimal
                    $found = $formulas
                        ->where('rule', $i_formula->rule)
                        ->where('name', $i_formula->name)
                        ->where(\DB::raw('CAST(value1 AS DECIMAL(18, 2))'), '<=', floatval($i_formula->value1))
                        ->where(\DB::raw('CAST(value2 AS DECIMAL(18, 2))'), '<=', floatval($i_formula->value2))
                        ->pluck('postage_id')
                        ->toArray();
                    array_push($founds, $found);
                    break;
                case 'Pair':
                    $found = $formulas
                        ->where('rule', $i_formula->rule)
                        ->where('name', $i_formula->name)
                        ->where('value1', $i_formula->value1)
                        ->where('value2', $i_formula->value2)
                        ->pluck('postage_id')
                        ->toArray();
                    array_push($founds, $found);
                    break;
                default:
                    break;
            }
        }

        $postage            = null;
        $result_postage_ids = collect($founds)->collapse();
        if (count($result_postage_ids) == count($i_formulas) && count($result_postage_ids->unique()) == 1) {
            $postage = Postage::find($result_postage_ids->unique()->first());
        }
        return [
            'postage' => $postage
        ];
    }
}