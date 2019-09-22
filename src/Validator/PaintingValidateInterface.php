<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface PaintingValidateInterface
{
    public function paintingValidator(Request $request, $type);
}