<?php

namespace App\Common;

class DBHelper
{
    static public function getWithCurrencyFormat($field_name, $name_output)
    {
        $signal = CurrencyHelper::$currencySignal;
        return "CONCAT(FORMAT({$field_name}, 0), '{$signal}') as {$name_output}";
    }

    static public function getWithDateFormat($field_name, $name_output)
    {
        $fd = DateTimeHelper::$stringFormatDateTime['date'];
        return "DATE_FORMAT($field_name, '{$fd}') as {$name_output}";
    }

    static public function getWithTimeFormat($field_name, $name_output)
    {
        $ft = DateTimeHelper::$stringFormatDateTime['time'];
        return "DATE_FORMAT($field_name, '{$ft}') as {$name_output}";
    }

    static public function getWithDateTimeFormat($field_name, $name_output)
    {
        $fd = DateTimeHelper::$stringFormatDateTime['date'];
        $ft = DateTimeHelper::$stringFormatDateTime['time'];
        return "DATE_FORMAT($field_name, '{$fd} - {$ft}') as {$name_output}";
    }
}