<?php

namespace App\Manager;

use Symfony\Component\HttpFoundation\Request;

interface FetchDataMangerInterface
{
    public function fetchData(Request $request,$entity);

}