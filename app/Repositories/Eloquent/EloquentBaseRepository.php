<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

use App\Repositories\BaseRepositoryInterface;
use App\Common\DateTimeHelper;
use Carbon\Carbon;

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
    public function deactivate($id)
    {
        if ($this->model->find($id)->update(['active' => false]))
            return 1;
        return 0;
    }

    /**
     * @inheritdoc
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function generateCode($prefix)
    {
        $code = $prefix . date('ymd');
        $stt  = $this->model->where('code', 'like', $code . '%')->get()->count() + 1;
        $code .= substr("00" . $stt, -3);
        return $code;
    }

    public function filterFromDateToDate($query, $field_name, $from_date, $to_date)
    {
        if ($from_date && $to_date) {
            $from_date = Carbon::createFromFormat('d/m/Y', $from_date)->toDateString();
            $to_date   = Carbon::createFromFormat('d/m/Y', $to_date)->toDateString();
            return $query->whereBetween($field_name, [DateTimeHelper::addTimeForDate($from_date, 'min')
                , DateTimeHelper::addTimeForDate($to_date, 'max')]);
        }
        return $query;
    }

    public function filterRangeDate($query, $field_name, $range)
    {
        if ($range && $range != 'none') {
            switch ($range) {
                case 'yesterday':
                    $query = $query
                        ->whereDate($field_name, DateTimeHelper::getYesterday('Y-m-d')['yesterday']);
                    break;
                case 'today':
                    $query = $query
                        ->whereDate($field_name, date('Y-m-d'));
                    break;
                case 'week':
                    $start_of_week = Carbon::now()->startOfWeek()->toDateString();
                    $end_of_week   = Carbon::now()->endOfWeek()->toDateString();
                    $query         = $query
                        ->whereBetween($field_name, [DateTimeHelper::addTimeForDate($start_of_week, 'min')
                            , DateTimeHelper::addTimeForDate($end_of_week, 'max')]);
                    break;
                case 'month':
                    $query = $query
                        ->whereMonth($field_name, date('m'))
                        ->whereYear($field_name, date('Y'));
                    break;
                case 'year':
                    $query = $query
                        ->whereYear($field_name, date('Y'));
                    break;
                default:
                    break;
            }
        }
        return $query;
    }

    public function filterColumn($query, $field_name, $value, $operator = '=')
    {
        if ($value)
            return $query->where($field_name, $operator, $value);
        return $query;
    }

    public function checkExistValue($field_name, $value, $skip_id = [])
    {
        // Check luôn cả dữ liệu đã deactivate [whereActive(true)]
        $exists = $this->model->where($field_name, $value)->whereNotIn('id', $skip_id)->get();
        return ($exists->count() > 0);
    }
}