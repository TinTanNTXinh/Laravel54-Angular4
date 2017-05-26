<?php

namespace App\Repositories;

interface DriverRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}