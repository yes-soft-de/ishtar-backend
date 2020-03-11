<?php


namespace App\Service;


use App\AutoMapping;
use App\Entity\ArtistTranslationEntity;
use App\Entity\PaintingTranslationEntity;
use App\Manager\TranslationManager;
use App\Response\CreateArtistTranslationResponse;
use App\Response\CreatePaintingTranslationResponse;

class TranslationService
{
    private $translation;
    private $autoMapping;

    public function __construct(TranslationManager $translation, AutoMapping $autoMapping)
    {
        $this->translation = $translation;
        $this->autoMapping = $autoMapping;
    }

    public function CreatePaintingTranslation($request)
    {
        $paintingTranslation =  $this->translation->CreatePaintingTranslation($request);

        $response = $this->autoMapping->map(PaintingTranslationEntity::class,CreatePaintingTranslationResponse::class, $paintingTranslation);

        return $response;
    }

    public function CreateArtistTranslation($request)
    {
        $artistTranslation =  $this->translation->CreateArtistTranslation($request);

        $response = $this->autoMapping->map(ArtistTranslationEntity::class,CreateArtistTranslationResponse::class, $artistTranslation);

        return $response;
    }

}