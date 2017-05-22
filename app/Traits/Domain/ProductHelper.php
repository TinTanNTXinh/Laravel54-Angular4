<?php

namespace App\Traits\Domain;

use App\Product;

trait ProductHelper
{
    public function readAllProduct()
    {
        $skeleton = Product::whereActive(true);

        return [
            'skeleton' => $skeleton
        ];
    }
}