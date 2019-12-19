<?php


namespace App\Manager;


use App\Repository\ArtistEntityRepository;

class HealthCheckManager
{

    private $artistEntityRepository;

    public function __construct(ArtistEntityRepository $artistEntityRepository)
    {
        $this->artistEntityRepository = $artistEntityRepository;
    }

    public function healthCheck($id)
    {
        $data =  $this->artistEntityRepository->findById($id);

        return $data;
    }
}