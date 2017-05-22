<?php

namespace App\Traits\Domain;

use App\UnitPricePark;

trait UnitPriceParkHelper
{
    public function readAllUnitPricePark()
    {
        $skeleton = UnitPricePark::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}