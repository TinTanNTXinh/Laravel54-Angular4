<?php

namespace App\Repositories;

interface LubeRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}