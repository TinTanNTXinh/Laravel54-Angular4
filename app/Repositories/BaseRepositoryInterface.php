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
     * @param  int $id
     * @return number (1 = success; 0 = fail)
     */
    public function deactivate($id);

    /**
     * @param  int $id
     * @return number (1 = success; 0 = fail)
     */
    public function destroy($id);

    public function get($query);

    public function searchFromDateToDate($query, $field_name, $from_date, $to_date);

    public function searchRangeDate($query, $field_name, $range);
}