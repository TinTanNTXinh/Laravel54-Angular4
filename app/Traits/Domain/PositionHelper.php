<?php

namespace App\Traits\Domain;

use App\Position;

trait PositionHelper
{
    public function readAllPosition()
    {
        $skeleton = Position::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}