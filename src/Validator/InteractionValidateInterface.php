<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface InteractionValidateInterface
{
    public function interactionValidator(Request $request, $type);
}