<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface VideoValidateInterface
{
    public function videoValidator(Request $request, $type);
}