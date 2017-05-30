<?php

namespace App\Repositories;

interface FormulaRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);

    public function deleteByPostageId($postage_id);

    public function readByPostageId($postage_id);

    public function findPostageIdByFormulas($i_formulas, $i_customer_id, $i_transport_date = null);
}