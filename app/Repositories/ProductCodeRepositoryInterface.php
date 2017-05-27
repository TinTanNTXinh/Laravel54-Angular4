<?php

namespace App\Repositories;

interface ProductCodeRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}