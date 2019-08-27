<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ArtistArtTypeValidateInterface
{
    public function artistArtTypeValidator(Request $request, $type);
}