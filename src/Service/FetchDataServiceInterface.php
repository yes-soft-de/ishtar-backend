<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface FetchDataServiceInterface
{

    public function fetchData(Request $request, $entity);
}
