<?php

namespace App\Repositories;

interface ProductTypeRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}