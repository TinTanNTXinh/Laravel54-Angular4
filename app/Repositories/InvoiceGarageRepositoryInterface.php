<?php

namespace App\Repositories;

interface InvoiceGarageRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}