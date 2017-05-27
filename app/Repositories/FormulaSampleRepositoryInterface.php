<?php

namespace App\Repositories;

interface FormulaSampleRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);
}