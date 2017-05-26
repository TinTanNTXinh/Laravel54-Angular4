<?php

namespace App\Traits\Common;

trait DBHelper
{
    public function generateCode($class_name, $prefix)
    {
        $code = $prefix . date('ymd');
        $stt  = $class_name::where('code', 'like', $code . '%')->get()->count() + 1;
        $code .= substr("00" . $stt, -3);
        return $code;
    }
}