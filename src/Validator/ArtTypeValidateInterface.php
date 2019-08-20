<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ArtTypeValidateInterface
{
    public function artTypeValidator(Request $request, $type);
}