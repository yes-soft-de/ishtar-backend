<?php

namespace App\Mapper;

use Symfony\Component\HttpFoundation\Request;

interface BaseCreateMapperInterface
{
    public function createMapper(Request $request, $entity);

}


