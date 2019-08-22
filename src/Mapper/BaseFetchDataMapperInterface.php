<?php


namespace App\Mapper;


use Symfony\Component\HttpFoundation\Request;

interface BaseFetchDataMapperInterface
{
    public function fetchDataMapper(Request $request, $entity);

}