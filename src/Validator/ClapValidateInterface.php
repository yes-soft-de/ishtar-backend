<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ClapValidateInterface
{
    public function clapValidator(Request $request, $type);
}