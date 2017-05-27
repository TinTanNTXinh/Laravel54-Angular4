<?php

namespace App\Repositories;

interface InvoiceDetailRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}