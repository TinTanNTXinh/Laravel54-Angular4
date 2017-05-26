<?php

namespace App\Common;

class DBHelper
{
    private $currencySignal;
    private $dateTimeHelper;

    public function __construct()
    {
        $this->dateTimeHelper = new DateTimeHelper();
        $this->currencySignal = CurrencyHelper::getCurrencySignal();
    }

    public function getWithCurrencyFormat($field_name, $name_output)
    {
        return "CONCAT(FORMAT({$field_name}, 0), '{$this->currencySignal}') as {$name_output}";
    }

    public function getWithDateFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->dateTimeHelper->getFormatDateTime()['date']}') as {$name_output}";
    }

    public function getWithTimeFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->dateTimeHelper->getFormatDateTime()['time']}') as {$name_output}";
    }

    public function getWithDateTimeFormat($field_name, $name_output)
    {
        return "DATE_FORMAT($field_name, '{$this->dateTimeHelper->getFormatDateTime()['date']} - {$this->dateTimeHelper->getFormatDateTime()['time']}') as {$name_output}";
    }
}