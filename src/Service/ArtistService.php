<?php


namespace App\Service;

use App\Controller\Artist;
use App\Manager\ArtistManager;
use App\Manager\CreateUpdateDeleteManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ArtistService
{

    private $manager;
    private $serializer;
    private $entityMnager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    public function create($artist)
    {
        $manager=new ArtistManager($this->entityManager);
         $result = $manager->create($artist);
         return $result;

        //return $this->response($result, "Created");
    }
}