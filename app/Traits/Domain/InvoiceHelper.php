<?php

namespace App\Traits\Domain;

use App\Invoice;

trait InvoiceHelper
{
    public function readAllInvoice($type)
    {
        $skeleton = [];
        switch ($type) {
            case 'CUSTOMER':
                $skeleton = Invoice::whereActive(true)->where('type2', '!=', '');
                break;
            case 'GARAGE':
                $skeleton = Invoice::whereActive(true)->where('type3', '!=', '');
                break;
            default:
                break;
        }

        return [
            'skeleton' => $skeleton
        ];
    }
}