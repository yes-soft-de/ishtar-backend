<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ClientValidateInterface
{

    public function ClientValidator(Request $request, $type);
}
