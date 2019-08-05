<?php


namespace App\Mapper;


use App\Entity\ArtistEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\HttpFoundation\Request;

class BaseMapper implements BaseMapperInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity)
        {
            case "Artist":
                $artistMapper = new ArtistMapper();
                $artistEntity = new ArtistEntity();
                return $artistMapper->artistData($data, $artistEntity);
                break;
        }
    }

    public function updateMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity)
        {
            case "Artist":
                $artistMapper = new ArtistMapper();
                return $artistMapper->artistData($data,
                    $this->entityManager->getRepository(ArtistEntity::class)->findOneById($data["id"]));
                break;
        }
    }

    public function deleteMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity)
        {
            case "Artist":
                return $this->entityManager->getRepository(ArtistEntity::class)->findOneById($data["id"]);
                break;
        }
    }
}