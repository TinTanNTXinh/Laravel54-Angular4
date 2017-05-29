<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PostageRepositoryInterface;
use App\Postage;
use App\Formula;
use DB;
use App\Common\DBHelper;

class PostageEloquentRepository extends EloquentBaseRepository implements PostageRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Postage::class;
    }

    public function allSkeleton()
    {
        return $this->model->where('postages.active', true)
            ->leftJoin('units', 'units.id', '=', 'postages.unit_id')
            ->select('postages.*'
                , 'units.name as unit_name'
                , DB::raw(DBHelper::getWithCurrencyFormat('postages.unit_price', 'fc_unit_price'))
                , DB::raw(DBHelper::getWithDateTimeFormat('postages.apply_date', 'fd_apply_date'))
            );
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('postages.id', $id);
    }

    public function readByCustomerIdFormulas($i_formulas, $i_customer_id, $i_transport_date = null)
    {
        if(!isset($i_transport_date))
            $i_transport_date = date('Y-m-d') . ' 00:00:00';

        $postage_ids = Postage::whereActive(true)
            ->where('customer_id', $i_customer_id)
            ->where('apply_date', '<', $i_transport_date)
            ->pluck('id')
            ->toArray();

        $formulas = Formula::whereActive(true)
            ->whereIn('postage_id', $postage_ids);

        $founds = [];
        foreach ($i_formulas as $key => $i_formula) {
            $found = null;
            switch ($i_formula->rule) {
                case 'SINGLE':
                    $found = $formulas
                        ->where('rule', $i_formula->rule)
                        ->where('name', $i_formula->name)
                        ->where(DB::raw("STRCMP(value1, '{$i_formula->value1}')"), 0)
                        ->pluck('postage_id')
                        ->toArray();
                    array_push($founds, $found);
                    break;
                case 'RANGE':
                case 'OIL':
                    // Convert to decimal
                    $found = $formulas
                        ->where('rule', $i_formula->rule)
                        ->where('name', $i_formula->name)
                        ->where(DB::raw('CAST(value1 AS DECIMAL(18, 2))'), '<=', floatval($i_formula->value1))
                        ->where(DB::raw('CAST(value2 AS DECIMAL(18, 2))'), '<=', floatval($i_formula->value2))
                        ->pluck('postage_id')
                        ->toArray();
                    array_push($founds, $found);
                    break;
                case 'PAIR':
                    $found = $formulas
                        ->where('rule', $i_formula->rule)
                        ->where('name', $i_formula->name)
                        ->where(DB::raw("STRCMP(value1, '{$i_formula->value1}')"), 0)
                        ->where(DB::raw("STRCMP(value2, '{$i_formula->value2}')"), 0)
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
            $postage_id = $result_postage_ids->unique()->first();
            $postage = Postage::where('postages.id', '=', $postage_id)
                ->leftJoin('units', 'units.id', '=', 'postages.unit_id')
                ->select('postages.*', 'units.name as unit_name')
                ->first();
        }
        return $postage;
    }

    public function readByCustomerId($customer_id)
    {
        return $this->allSkeleton()
            ->where('customer_id', $customer_id)
            ->get();
    }

}