<?php

namespace App\Interfaces;

interface IReport
{
    /** API METHOD */
    public function getReadAll();

    public function getSearchOne();

    /** LOGIC METHOD */
    public function readAll();

    public function searchOne($filter);
}