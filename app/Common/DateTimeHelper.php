<?php

namespace App\Common;

use Carbon\Carbon;

class DateTimeHelper
{
    static public $stringFormatDateTime = [
        'date' => '%d/%m/%Y',
        'time' => '%H:%i'
    ];

    static public function getFirstDayLastDay($month = null, $year = null, $pattern = 'd-m-Y')
    {
        if (!isset($month))
            $month = date('m');
        if (!isset($year))
            $year = date('Y');

        $first_day_UTS = mktime(0, 0, 0, $month, 1, $year);
        $last_day_UTS  = mktime(0, 0, 0, $month, date('t', strtotime($year . '-' . $month . '-' . '01')), $year);
        return [
            'first_day' => date($pattern, $first_day_UTS),
            'last_day'  => date($pattern, $last_day_UTS),
            'today'     => date($pattern)
        ];
    }

    static public function getYesterday($pattern = 'd-m-Y')
    {
        $yesterday = mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"));
        return [
            'yesterday' => date($pattern, $yesterday)
        ];
    }

    static public function addTimeForDate($date, $mode)
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

    static public function toStringDateTimeClientForDB($date, $format = 'd/m/Y H:i:s')
    {
        return Carbon::createFromFormat($format, $date)->toDateTimeString();
    }

    static public function compareDateTime($d1, $fd1, $d2, $fd2)
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