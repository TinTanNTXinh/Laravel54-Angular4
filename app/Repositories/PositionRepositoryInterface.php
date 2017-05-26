<?php

namespace App\Repositories;

interface PositionRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}