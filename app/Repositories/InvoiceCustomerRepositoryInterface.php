<?php

namespace App\Repositories;

interface InvoiceCustomerRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}