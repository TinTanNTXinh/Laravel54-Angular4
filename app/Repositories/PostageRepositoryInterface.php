<?php

namespace App\Repositories;

interface PostageRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);

    public function readByCustomerId($customer_id);

    public function findByCustomerIdAndTransportDate($customer_id, $transport_date = null);

}