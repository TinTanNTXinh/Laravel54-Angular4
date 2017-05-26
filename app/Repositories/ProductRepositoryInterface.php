<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}