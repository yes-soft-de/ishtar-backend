<?php


namespace App\Exception;

use http\Exception;
use Symfony\Component\HttpFoundation\Response;
class EntityException
{
    public function entityNotFound($entity)
    {
        throw new \Exception("No ".$entity." found with this ID");
    }
}