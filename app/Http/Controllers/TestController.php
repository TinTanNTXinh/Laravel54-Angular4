<?php

namespace App\Http\Controllers;

use App\Traits\FormulaHelper;
use App\Traits\PostageHelper;
use Illuminate\Http\Request;
use App\Interfaces\ICrud;
use App\Interfaces\IValidate;

class TestController extends Controller
{
    use FormulaHelper, PostageHelper;

    public function index()
    {
//        $formulas = $this->findFormulas(1);
//        return $formulas;

        $postage = $this->findPostage([[
            'rule' => 'S',
            'name' => 'Tỉnh',
            'value' => 'Đồng Nai'
        ]], 1);
        return $postage;
    }
}
