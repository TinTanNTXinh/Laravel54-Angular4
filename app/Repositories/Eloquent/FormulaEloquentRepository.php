<?php

namespace App\Repositories\Eloquent;

use App\Repositories\FormulaRepositoryInterface;
use App\Formula;
use DB;

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

    public function deleteByPostageId($postage_id)
    {
        return $this->allActiveQuery()
            ->where('postage_id', $postage_id)
            ->delete();
    }

    public function readByPostageId($postage_id)
    {
        $formulas = $this->allActiveQuery()
            ->where('postage_id', $postage_id)
            ->get();

        return $formulas;
    }

    public function findPostageIdByFormulas($i_formulas, $i_customer_id, $i_transport_date = null)
    {
        if (!isset($i_transport_date))
            $i_transport_date = date('Y-m-d') . ' 00:00:00';

        $formulas = $this->allActiveQuery('formulas.active')
            ->leftJoin('postages', 'postages.id', '=', 'formulas.postage_id')
            ->where('postages.customer_id', $i_customer_id)
            ->where('postages.apply_date', '<', $i_transport_date);

        $founds = [];
        foreach ($i_formulas as $key => $i_formula) {
            $found = null;
            switch ($i_formula->rule) {
                case 'SINGLE':
                    $found = $formulas
                        ->where('formulas.rule', $i_formula->rule)
                        ->where('formulas.name', $i_formula->name)
                        ->where(DB::raw("STRCMP(formulas.value1, '{$i_formula->value1}')"), 0)
                        ->pluck('formulas.postage_id')
                        ->toArray();
                    array_push($founds, $found);
                    break;
                case 'RANGE':
                case 'OIL':
                    // Convert to decimal
                    $found = $formulas
                        ->where('formulas.rule', $i_formula->rule)
                        ->where('formulas.name', $i_formula->name)
                        ->where(DB::raw('CAST(formulas.value1 AS DECIMAL(18, 2))'), '<=', floatval($i_formula->value1))
                        ->where(DB::raw('CAST(formulas.value2 AS DECIMAL(18, 2))'), '<=', floatval($i_formula->value2))
                        ->pluck('formulas.postage_id')
                        ->toArray();
                    array_push($founds, $found);
                    break;
                case 'PAIR':
                    $found = $formulas
                        ->where('formulas.rule', $i_formula->rule)
                        ->where('formulas.name', $i_formula->name)
                        ->where(DB::raw("STRCMP(formulas.value1, '{$i_formula->value1}')"), 0)
                        ->where(DB::raw("STRCMP(formulas.value2, '{$i_formula->value2}')"), 0)
                        ->pluck('formulas.postage_id')
                        ->toArray();
                    array_push($founds, $found);
                    break;
                default:
                    break;
            }
        }

        $postage_id         = 0;
        $result_postage_ids = collect($founds)->collapse();
        if (count($result_postage_ids) == count($i_formulas) && count($result_postage_ids->unique()) == 1) {
            $postage_id = $result_postage_ids->unique()->first();
        }
        return $postage_id;
    }


}