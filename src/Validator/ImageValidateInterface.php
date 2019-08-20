<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ImageValidateInterface
{
    public function imageValidator(Request $request, $type);
}