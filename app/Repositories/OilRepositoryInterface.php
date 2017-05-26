<?php

namespace App\Repositories;

interface OilRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}