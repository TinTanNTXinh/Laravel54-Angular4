<?php

namespace App\Repositories;

interface FormulaRepositoryInterface
{
    public function readByCustomerId($customer_id, $transport_date);
}