<?php

namespace App\Repositories;

interface TransportFormulaRepositoryInterface
{
    public function allSkeleton();

    public function oneSkeleton($id);

    public function readByTransportId($transport_id);

    public function deleteByTransportId($transport_id);

    public function deactivateByTransportId($transport_id);
}