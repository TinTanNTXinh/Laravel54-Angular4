<?php

namespace App\Traits\Domain;

use App\Transport;

trait TransportHelper
{
    public function readAllTransport()
    {
        $skeleton = Transport::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}