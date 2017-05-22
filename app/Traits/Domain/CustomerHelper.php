<?php

namespace App\Traits\Domain;

use App\Customer;

trait CustomerHelper
{
    public function readAllCustomer()
    {
        $skeleton = Customer::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}