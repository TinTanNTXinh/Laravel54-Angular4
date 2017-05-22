<?php

namespace App\Traits\Domain;

use App\Garage;

trait GarageHelper
{
    public function readAllGarage()
    {
        $skeleton = Garage::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}