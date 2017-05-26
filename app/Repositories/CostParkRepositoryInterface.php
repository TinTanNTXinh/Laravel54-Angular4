<?php

namespace App\Repositories;

interface CostParkRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}