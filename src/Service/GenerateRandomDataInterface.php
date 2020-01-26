<?php

namespace App\Service;

interface GenerateRandomDataInterface
{
    function generateRandomString();

    public function generateRandomDate();

    public function generateRandomInt($min, $max);
}