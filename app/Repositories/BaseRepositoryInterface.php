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

    /**
     * @param $prefix
     * @return mixed
     */
    public function generateCode($prefix);

    /**
     * @param $query
     * @param $field_name
     * @param $from_date
     * @param $to_date
     * @return mixed
     */
    public function filterFromDateToDate($query, $field_name, $from_date, $to_date);

    /**
     * @param $query
     * @param $field_name
     * @param $range
     * @return mixed
     */
    public function filterRangeDate($query, $field_name, $range);

    /**
     * @param $query
     * @param $field_name
     * @param $value
     * @param string $operator
     * @return mixed
     */
    public function filterColumn($query, $field_name, $value, $operator = '=');

    /**
     * @param $field_name
     * @param $value
     * @param array $skip_id
     * @return mixed
     */
    public function checkExistValue($field_name, $value, $skip_id = []);
}