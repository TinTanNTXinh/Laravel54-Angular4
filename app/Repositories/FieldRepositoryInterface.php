<?php

namespace App\Repositories;

interface FieldRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}