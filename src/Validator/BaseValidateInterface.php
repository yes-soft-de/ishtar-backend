<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface BaseValidateInterface
{
    public function baseValidator(Request $request, $type,$entity);
}