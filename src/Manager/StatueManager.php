<?php


namespace App\Manager;

use App\Entity\ArtistEntity;
use App\Entity\EntityMediaEntity;
use App\Entity\StatueEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\StatueMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;

class StatueManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $statue = json_decode($request->getContent(),true);
        $statueEntity=new StatueEntity();
        $statueMapper = new StatueMapper();
        $statueData=$statueMapper->StatueData($statue, $statueEntity,$this->entityManager);
        $this->entityManager->persist($statueData);
        $this->entityManager->flush();
        return $statueData;
    }
    public function update(Request $request)
    {
        $statue = json_decode($request->getContent(),true);
        $statueEntity=$this->entityManager->getRepository(StatueEntity::class)->getStatue($request->get('id'));
        if (!$statueEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("statue");
        }
        else {
            $statueMapper = new StatueMapper();
            $statueMapper->StatueData($statue, $statueEntity,$this->entityManager);
            $this->entityManager->flush();
            return $statueEntity;
        }
    }
    public function delete(Request $request)
    {
        $statue = json_decode($request->getContent(),true);
        $statueEntity=$this->entityManager->getRepository(StatueEntity::class)->getStatue($statue['id']);
        if (!$statueEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("statue");
        }
        else {

            $this->entityManager->flush();
            return $statueEntity;
        }
    }
    public function getAll()
    {
        $data=$this->entityManager->getRepository(StatueEntity::class)->getAll();

        return $data;
    }

    public function getStatueById($request)
    {
        return $result = $this->entityManager->getRepository(StatueEntity::class)->findOneById($request);
    }

}
