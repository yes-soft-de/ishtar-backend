<?php


namespace App\Mapper;


use Symfony\Component\HttpFoundation\Request;

interface BaseUpdateMapperInterface
{
    public function updateMapper(Request $request, $entity);

}