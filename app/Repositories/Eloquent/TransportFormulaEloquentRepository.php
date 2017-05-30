<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TransportFormulaRepositoryInterface;
use App\TransportFormula;

class TransportFormulaEloquentRepository extends EloquentBaseRepository implements TransportFormulaRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return TransportFormula::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('transport_formulas.id', $id);
    }

    public function readByTransportId($transport_id)
    {
        return $this->allActiveQuery()
            ->where('transport_id', $transport_id)
            ->get();
    }

    public function deleteByTransportId($transport_id)
    {
        return $this->allActiveQuery()
            ->where('transport_id', $transport_id)
            ->delete();
    }

    public function deactivateByTransportId($transport_id)
    {
        return $this->allActiveQuery()
            ->where('transport_id', $transport_id)
            ->update(['active' => false]);
    }
}