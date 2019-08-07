<?php


namespace App\Mapper;


use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\PantingImageEntity;
use Doctrine\ORM\EntityManagerInterface;
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

            case "ArtType":
                $artTypeMapper = new ArtTypeMapper();
                $artTypeEntity = new ArtTypeEntity();
                return $artTypeMapper->artTypeData($data, $artTypeEntity);
                break;

            case "PantingImage":
                $pantingImageMapper = new PantingImageMapper();
                $pantingImageEntity = new PantingImageEntity();
                return $pantingImageMapper->PantingImageData($data, $pantingImageEntity);
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

            case "ArtType":
                $artTypeMapper = new ArtTypeMapper();
                return $artTypeMapper->artTypeData($data,
                    $this->entityManager->getRepository(ArtTypeEntity::class)->findOneById($data["id"]));
                break;

            case "PantingImage":
                $pantingImageMapper = new PantingImageMapper();
                return $pantingImageMapper->PantingImageData($data,
                    $this->entityManager->getRepository(PantingImageEntity::class)->findOneById($data["id"]));
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

            case "ArtType":
                return $this->entityManager->getRepository(ArtTypeEntity::class)->findOneById($data["id"]);
                break;

            case "PantingImage":
                return $this->entityManager->getRepository(PantingImageEntity::class)->findOneById($data["id"]);
                break;
        }
    }
}