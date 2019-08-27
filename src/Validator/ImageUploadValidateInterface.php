<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ImageUploadValidateInterface
{
    public function artistValidator(Request $request, $type);
}