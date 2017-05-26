<?php

namespace App\Repositories;

interface TruckRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}