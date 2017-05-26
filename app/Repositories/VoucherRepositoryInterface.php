<?php

namespace App\Repositories;

interface VoucherRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}