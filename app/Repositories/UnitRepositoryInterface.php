<?php

namespace App\Repositories;

interface UnitRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}