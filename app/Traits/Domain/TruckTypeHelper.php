<?php

namespace App\Traits\Domain;

use App\TruckType;

trait TruckTypeHelper
{
    public function readAllTruckType()
    {
        $skeleton = TruckType::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}