<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface CommentValidateInterface
{
    public function commentValidator(Request $request, $type);
}