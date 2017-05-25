<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Eloquent\EloquentBaseRepository;
use App\Repositories\TransportRepositoryInterface;
use App\Transport;

class EloquentTransportRepository extends EloquentBaseRepository implements TransportRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return Transport::class;
    }

    /**
     * Lấy danh sách các post đã active
     * @return object
     */
    public function allActive()
    {
        return $this->model->whereActive(true)->get();
    }
}