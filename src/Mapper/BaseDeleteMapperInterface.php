<?php


namespace App\Mapper;


use Symfony\Component\HttpFoundation\Request;

interface BaseDeleteMapperInterface
{
    public function deleteMapper(Request $request, $entity);
}