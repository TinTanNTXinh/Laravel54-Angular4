<?php

namespace App\Repositories;

interface TruckTypeRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}