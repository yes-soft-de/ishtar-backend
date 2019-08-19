<?php

namespace App\Mapper;

use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\PaintingEntity;
use DateTime;
use Exception;

class PaintingMapper
{
    private $en;
    public function PaintingData($data, PaintingEntity $painting,$entityManger)
    {
        $this->en=$entityManger;
        $name = $data["name"];
        $artist = $this->en->getRepository(ArtistEntity::class)->find($data["artist"]);
        $artType = $artType = $this->en->getRepository(ArtTypeEntity::class)->find($data["artType"]);
        //this (try catch) just to make IDE happy, must use date calender in frontend
        //if date empty the date of today will be there
        try {
            $addingDate = new DateTime((string)$data["addingDate"]);
        } catch (Exception $e) {
        }
        $state = $data["state"];
        $deminsions = $data["deminsions"];
        $colorsType = $data["colorsType"];
        $price = $data["price"];
        $story = $data["story"];

        $painting->setName($name)
            ->setArtist($artist)
            ->setArtType($artType)
            ->setAddingDate($addingDate)
            ->setStory($story)
            ->setState($state)
            ->setDeminsions($deminsions)
            ->setColorsType($colorsType)
            ->setPrice($price);
        return $painting;
    }
}