<?php

namespace App\Repositories;

interface PostageRepositoryInterface
{
    public function readByCustomer($customer_id);
}