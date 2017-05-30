<?php

namespace App\Repositories;

interface LubeRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);

    public function findByApplyDate($i_apply_date = null);
}