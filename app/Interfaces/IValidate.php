<?php

namespace App\Interfaces;

interface IValidate
{
    /** VALIDATION */
    public function validateInput($data);

    public function validateEmpty($data);

    public function validateLogic($data);
}