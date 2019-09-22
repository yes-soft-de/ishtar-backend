<?php


namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;

interface ArtistValidateInterface
{
    public function artistValidator(Request $request, $type);

}