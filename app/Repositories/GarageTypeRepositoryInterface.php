<?php

namespace App\Repositories;

interface GarageTypeRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}