<?php

namespace App\Repositories;

interface CustomerTypeRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}