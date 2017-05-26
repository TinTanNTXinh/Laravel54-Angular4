<?php

namespace App\Repositories\Eloquent;

use App\Repositories\TransportVoucherRepositoryInterface;
use App\TransportVoucher;

class TransportVoucherEloquentRepository extends EloquentBaseRepository implements TransportVoucherRepositoryInterface
{
    /**
     * Khai báo Model
     */
    public function setModel()
    {
        return TransportVoucher::class;
    }

    public function allSkeleton()
    {
        return $this->model->whereActive(true);
    }

    public function oneSkeleton($id)
    {
        return $this->allSkeleton()->where('.id', $id);
    }

    public function readByTransportId($transport_id)
    {
        return $this->model->whereActive(true)
            ->where('transport_id', $transport_id)
            ->get();
    }

    public function deleteByTransportId($transport_id)
    {
        return $this->readByTransportId($transport_id)->delete();
//        $ids = $this->readByTransportId($transport_id)->pluck('id')->toArray();
//        $this->model->destroy($ids);
    }

    public function deactivateByTransportId($transport_id)
    {
        return $this->readByTransportId($transport_id)->update(['active' => false]);
    }
}