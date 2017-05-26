<?php

namespace App\Repositories;

interface FormulaRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);

    public function readByCustomerId($customer_id, $transport_date);
}