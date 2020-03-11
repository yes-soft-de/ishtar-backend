<?php


namespace App\Manager;

use App\AutoMapping;
use App\Entity\ArtistTranslationEntity;
use App\Entity\PaintingTranslationEntity;
use App\Request\CreateArtistTranslationRequest;
use App\Request\CreatePaintingTranslationRequest;
use Doctrine\ORM\EntityManagerInterface;

class TranslationManager
{
    private $autoMapping;
    private $entityManager;

    public function __construct(AutoMapping $autoMapping, EntityManagerInterface $entityManagerInterface)
    {
        $this->autoMapping = $autoMapping;
        $this->entityManager = $entityManagerInterface;
    }

    public function CreatePaintingTranslation(CreatePaintingTranslationRequest $request)
    {
        $entity = $this->autoMapping->map(CreatePaintingTranslationRequest::class, PaintingTranslationEntity::class, $request);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        $this->entityManager->clear();

        return $entity;
    }

    public function CreateArtistTranslation(CreateArtistTranslationRequest $request)
    {
        $entity = $this->autoMapping->map(CreateArtistTranslationRequest::class, ArtistTranslationEntity::class, $request);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        $this->entityManager->clear();

        return $entity;
    }

}