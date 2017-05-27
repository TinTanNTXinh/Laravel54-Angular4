<?php

namespace App\Repositories;

interface DriverTruckRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}