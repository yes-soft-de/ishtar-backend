<?php


namespace App\Manager;


class EntityException
{

    /**
     * EntityException constructor.
     */
    public function __construct()
    {
    }

    public function entityNotFound(string $string)
    {
        return "entity Not Found";
    }
}