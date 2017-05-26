<?php

namespace App\Repositories;

interface TransportRepositoryInterface
{
    /**
     * Lấy danh sách các post đã active
     * @return object
     */
    public function allSkeleton();

    public function oneSkeleton($id);
}