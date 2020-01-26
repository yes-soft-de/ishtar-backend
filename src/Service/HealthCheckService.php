<?php


namespace App\Service;


use App\Manager\HealthCheckManager;

class HealthCheckService
{

    private $healthCheck;
    private $generateRandomData;

    public function __construct(HealthCheckManager $healthCheck, GenerateRandomData $generateRandomData)
    {
        $this->healthCheck = $healthCheck;
        $this->generateRandomData = $generateRandomData;
    }

    public function healthCheck()
    {
        $result = $this->healthCheck->healthCheck(
            $this->generateRandomData->generateRandomInt(1,10)
        );

        return $result;
    }

}