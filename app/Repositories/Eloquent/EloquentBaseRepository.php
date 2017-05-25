<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\BaseRepositoryInterface;

/**
 * Class EloquentBaseRepository
 */
abstract class EloquentBaseRepository implements BaseRepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model An instance of the Eloquent Model
     */
    protected $model;

    /**
     * @param Model $model
     */
    public function __construct()
    {
        $this->getModel();
    }

    /**
     * @get Model
     */
    abstract function setModel();

    /**
     * @set Model
     */
    private function getModel()
    {
        $model       = $this->setModel();
        $this->model = app()->make($model);
    }

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data)
    {
        $model->update($data);

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function deactivate($model, $id)
    {
        $obj         = $model->find($id);
        $obj->active = false;
        $obj->update();
        return $obj;
    }

    /**
     * @inheritdoc
     */
    public function destroy($model, $id)
    {
        return $model->destroy($id);
    }
}