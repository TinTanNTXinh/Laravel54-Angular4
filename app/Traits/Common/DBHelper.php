<?php

namespace App\Traits\Common;

trait DBHelper
{
    use CurrencyHelper;

    public function getWithCurrencyFormat($field_name, $name_output)
    {
        return "CONCAT(FORMAT({$field_name}, 0), '{$this->getCurrencySignal()}') as {$name_output}";
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
}