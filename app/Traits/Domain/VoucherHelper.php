<?php

namespace App\Traits\Domain;

use App\Voucher;

trait VoucherHelper
{
    public function readAllVoucher()
    {
        $skeleton = Voucher::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}