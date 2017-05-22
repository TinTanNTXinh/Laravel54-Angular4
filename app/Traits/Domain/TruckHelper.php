<?php

namespace App\Traits\Domain;

use App\Truck;

trait TruckHelper
{
    public function readAllTruck()
    {
        $skeleton = Truck::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}