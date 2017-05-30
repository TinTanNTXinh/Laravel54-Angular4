<?php

namespace App\Repositories;

interface OilRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);

    public function findByApplyDate($i_apply_date = null);
}