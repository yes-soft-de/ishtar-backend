<?php


namespace App\Mapper;


use App\Entity\ArtTypeEntity;

class ArtTypeMapper
{
    public function artTypeData($data, ArtTypeEntity $artType)
    {
        $name    = $data["name"];
        $history = $data["history"];
        $story   = $data["story"];
        $image   = $data["image"];
        $video   = $data["video"];

        $artType->setName($name)
            ->setHistory($history)
            ->setStory($story)
            ->setImage($image)
            ->setVideo($video);

        return $artType;
    }
}