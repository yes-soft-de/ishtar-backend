<?php


namespace App\Service;


class GenerateRandomData implements GenerateRandomDataInterface
{

    public function generateRandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 10;

        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function generateRandomDate()
    {
        $minDate = strtotime("1950-1-1");
        $maxDate = strtotime("1995-12-30");

        // Generate a random number from the start and end dates
        $value = mt_rand($minDate, $maxDate);

        // Convert back to the specified date format
        return date("Y-m-d", $value);
    }

    public function generateRandomInt($min, $max)
    {
        return mt_rand($min, $max);
    }
}