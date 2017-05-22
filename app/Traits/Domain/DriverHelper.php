<?php

namespace App\Traits\Domain;

use App\Driver;

trait DriverHelper
{
    public function readAllDriver()
    {
        $skeleton = Driver::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}