<?php

namespace App\Repositories;

interface CostLubeRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}