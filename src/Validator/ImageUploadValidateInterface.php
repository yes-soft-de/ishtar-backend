<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ImageUploadValidateInterface
{
    public function uploadedFileValidator(Request $request, $type);
}