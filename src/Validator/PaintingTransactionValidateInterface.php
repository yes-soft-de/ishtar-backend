<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface PaintingTransactionValidateInterface
{
    public function paintingTransactionValidator(Request $request, $type);
}