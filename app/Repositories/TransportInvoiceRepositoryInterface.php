<?php

namespace App\Repositories;

interface TransportInvoiceRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}