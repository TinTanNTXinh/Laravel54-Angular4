<?php

namespace App\Traits\Domain;

use App\StaffCustomer;

trait StaffCustomerHelper
{
    public function readAllStaffCustomer()
    {
        $skeleton = StaffCustomer::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}