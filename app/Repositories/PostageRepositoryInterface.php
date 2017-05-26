<?php

namespace App\Repositories;

interface PostageRepositoryInterface
{
    public function readByCustomerIdFormulas($i_formulas, $i_customer_id, $i_transport_date);
}