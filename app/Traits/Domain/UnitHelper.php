<?php

namespace App\Traits\Domain;

use App\Unit;

trait UnitHelper
{
    public function readAllUnit()
    {
        $skeleton = Unit::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}