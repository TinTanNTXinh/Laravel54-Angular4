<?php

namespace App\Traits;

use Carbon\Carbon;

trait DBHelper
{
    /** DATE TIME HELPER */
    public function getCurrentMonth($pattern = 'd-m-Y')
    {
        $first_day_UTS = mktime(0, 0, 0, date("m"), 1, date("Y"));
        $last_day_UTS  = mktime(0, 0, 0, date("m"), date('t'), date("Y"));
        return [
            'first_day' => date($pattern, $first_day_UTS),
            'last_day'  => date($pattern, $last_day_UTS),
            'today'     => date($pattern)
        ];
    }

    public function getFirstDayLastDay($month, $year, $pattern = 'd-m-Y')
    {
        $first_day_UTS = mktime(0, 0, 0, $month, 1, $year);
        $last_day_UTS  = mktime(0, 0, 0, $month, date('t', strtotime($year . '-' . $month . '-' . '01')), $year);
        return [
            'first_day' => date($pattern, $first_day_UTS),
            'last_day'  => date($pattern, $last_day_UTS),
        ];
    }

    public function getYesterday($pattern = 'd-m-Y')
    {
        $yesterday = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
        return [
            'yesterday' => date($pattern, $yesterday)
        ];
    }

    public function getFormatDateTime()
    {
        return [
            'date' => '%d/%m/%Y',
            'time' => '%H:%i'
        ];
    }

    public function getFormatDateTimeVsys()
    {
        return [
            'datetime' => 'd/m/y H:i:s',
        ];
    }

    public function addTimeForDate($date, $mode)
    {
        // mark: yyyy/mm/dd hh:ii:ss
        switch ($mode) {
            case 'min':
                return substr($date, 0, 10) . ' 00:00:00';
                break;
            case 'max':
                return substr($date, 0, 10) . ' 23:59:59';
                break;
            case 'none':
                return substr($date, 0, 10);
                break;
            default:
                return $date;
                break;
        }
    }

    public function toStringDateTimeClientForDB($date, $format = 'd/m/Y H:i:s')
    {
        return Carbon::createFromFormat($format, $date)->toDateTimeString();
    }

    /** DB HELPER */
    public function generateCode($class_name, $prefix)
    {
        $code = $prefix . date('ymd');
        $stt  = $class_name::where('code', 'like', $code . '%')->get()->count() + 1;
        $code .= substr("00" . $stt, -3);
        return $code;
    }

    public function checkExistData($class_name, $field_name, $value, $skip_id = [])
    {
        $exists = $class_name::whereActive(true)->where($field_name, $value)->whereNotIn('id', $skip_id)->get();
        // $exists = app($class_name)->whereActive(true)->where($field_name, $value)->get();
        return ($exists->count() > 0);
    }

    public function getWithCurrencyFormat($field_name, $name_output)
    {
        return "CONCAT(FORMAT({$field_name}, 0), 'đ') as {$name_output}";
    }

    public function getWithDateFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->getFormatDateTime()['date']}') as {$name_output}";
    }

    public function getWithTimeFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->getFormatDateTime()['time']}') as {$name_output}";
    }

    public function getWithDateTimeFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->getFormatDateTime()['date']} - {$this->getFormatDateTime()['time']}') as {$name_output}";
    }

    public function searchFromDateToDate($query, $field_name, $from_date, $to_date)
    {
        if ($from_date && $to_date) {
            $from_date = Carbon::createFromFormat('d/m/Y', $from_date)->toDateString();
            $to_date   = Carbon::createFromFormat('d/m/Y', $to_date)->toDateString();
            return $query->whereBetween($field_name, [$this->addTimeForDate($from_date, 'min'), $this->addTimeForDate($to_date, 'max')]);
        }
        return $query;
    }

    public function searchRangeDate($query, $field_name, $range)
    {
        if ($range && $range != 'none') {
            switch ($range) {
                case 'yesterday':
                    $query = $query
                        ->whereDate($field_name, $this->getYesterday('Y-m-d')['yesterday']);
                    break;
                case 'today':
                    $query = $query
                        ->whereDate($field_name, date('Y-m-d'));
                    break;
                case 'week':
                    $start_of_week = Carbon::now()->startOfWeek()->toDateString();
                    $end_of_week   = Carbon::now()->endOfWeek()->toDateString();
                    $query         = $query
                        ->whereBetween($field_name, [$this->addTimeForDate($start_of_week, 'min'), $this->addTimeForDate($end_of_week, 'max')]);
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

    public function searchFieldName($query, $field_name, $value, $operator = '=')
    {
        if ($value)
            return $query->where($field_name, $operator, $value);
        return $query;
    }

    private function compareDateTime($d1, $fd1, $d2, $fd2)
    {
        $a = Carbon::createFromFormat($fd1, $d1);
        $b = Carbon::createFromFormat($fd2, $d2);
        if ($a->diffInMinutes($b, false) == 0)
            return 0; // a = b
        else if ($a->diffInMinutes($b, false) > 0)
            return 1; // a > b
        else
            return -1; // a < b
    }
}