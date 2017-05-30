<?php

namespace App\Repositories\Eloquent;

use App\Repositories\GarageRepositoryInterface;
use App\Garage;

class GarageEloquentRepository extends EloquentBaseRepository implements GarageRepositoryInterface
{
    /** ===== INIT MODEL ===== */
    public function setModel()
    {
        return Garage::class;
    }

    /** ===== PUBLIC FUNCTION ===== */
    public function allSkeleton()
    {
        return $this->allActiveQuery('garages.active')
            ->leftJoin('garage_types', 'garage_types.id', '=', 'garages.garage_type_id')
            ->select('garages.*'
                , 'garage_types.name as garage_type_name'
            );
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('garages.id', $id);
    }
}