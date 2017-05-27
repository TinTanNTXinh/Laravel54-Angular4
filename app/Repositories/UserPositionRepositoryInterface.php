<?php

namespace App\Repositories;

interface UserPositionRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}