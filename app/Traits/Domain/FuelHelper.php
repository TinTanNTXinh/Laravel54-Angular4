<?php

namespace App\Traits\Domain;

use App\Fuel;

trait FuelHelper
{
    public function readAllFuel($type)
    {
        $skeleton = Fuel::whereActive(true)->where('type', $type);

        return [
            'skeleton' => $skeleton
        ];
    }

    public function currentFuel($type, $apply_date = null)
    {
        if(!isset($apply_date))
            $apply_date = date('Y-m-d') . ' 00:00:00';

        $fuel = Fuel::whereActive(true)
            ->where('type', $type)
            ->where('apply_date', '<=', $apply_date)
            ->orderBy('apply_date', 'desc')
            ->first();

        return [
            $type => $fuel
        ];

    }
}