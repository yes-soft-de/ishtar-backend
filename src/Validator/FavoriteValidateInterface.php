<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface FavoriteValidateInterface
{

    public function FavoriteValidator(Request $request, $type);
}
