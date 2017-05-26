<?php

namespace App\Repositories\Eloquent;

use App\Repositories\PostageRepositoryInterface;
use App\Postage;
use App\Formula;

class PostageEloquentRepository extends EloquentBaseRepository implements PostageRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Postage::class;
    }

    public function readByCustomer($customer_id)
    {
        $postages = Postage::whereActive(true)
            ->where('customer_id', $customer_id)
            ->get();

        $postage_ids = $postages->pluck('id')
            ->toArray();

        $formulas = Formula::whereActive(true)
            ->whereIn('postage_id', $postage_ids)
            ->get();

        $postages->map(function($postage){

        });
    }

}