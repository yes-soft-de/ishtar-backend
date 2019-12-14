<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface StatueValidateInterface
{
    public function statueValidator(Request $request, $type);
}