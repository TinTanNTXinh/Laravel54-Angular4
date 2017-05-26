<?php

namespace App\Repositories;

interface CustomerRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}