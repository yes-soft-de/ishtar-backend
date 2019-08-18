<?php

namespace App\Mapper;

use Symfony\Component\HttpFoundation\Request;

interface BaseMapperInterface
{
    public function createMapper(Request $request, $entity);

    public function updateMapper(Request $request, $entity);

    public function deleteMapper(Request $request, $entity);
}