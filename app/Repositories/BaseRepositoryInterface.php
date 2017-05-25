<?php

namespace App\Repositories;

/**
 * Interface CoreRepository
 * @package App\Repositories
 */
interface BaseRepositoryInterface
{
    /**
     * @param  int $id
     * @return $model
     */
    public function find($id);

    /**
     * Return a collection of all elements of the resource
     */
    public function all();

    /**
     * Create a resource
     * @param  $data
     * @return $model
     */
    public function create($data);

    /**
     * Update a resource
     * @param  $model
     * @param  array $data
     * @return $model
     */
    public function update($model, $data);

    /**
     * @param  $model
     * @param  int $id
     * @return $model
     */
    public function deactivate($model, $id);

    /**
     * @param  $model
     * @param  int $id
     * @return $model
     */
    public function destroy($model, $id);
}