<?php

namespace App\Repositories;

interface CostOtherRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}