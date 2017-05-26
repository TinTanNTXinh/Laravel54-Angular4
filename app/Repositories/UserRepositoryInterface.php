<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}