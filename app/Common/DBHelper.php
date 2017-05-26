<?php

namespace App\Common;

class DBHelper
{
    private $currencySignal;
    private $format_date, $format_time;

    public function __construct()
    {
        $this->currencySignal = CurrencyHelper::$currencySignal;
        $this->format_date    = DateTimeHelper::$stringFormatDateTime['date'];
        $this->format_time    = DateTimeHelper::$stringFormatDateTime['time'];
    }

    public function getWithCurrencyFormat($field_name, $name_output)
    {
        return "CONCAT(FORMAT({$field_name}, 0), '{$this->currencySignal}') as {$name_output}";
    }

    public function getWithDateFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->format_date}') as {$name_output}";
    }

    public function getWithTimeFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->format_time}') as {$name_output}";
    }

    public function getWithDateTimeFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->format_date} - {$this->format_time}') as {$name_output}";
    }
}