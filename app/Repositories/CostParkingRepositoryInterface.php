<?php

namespace App\Repositories;

interface CostParkingRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}