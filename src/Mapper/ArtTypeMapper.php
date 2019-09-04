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

        $artType->setName($name)
            ->setHistory($history)
            ->setStory($story);

        return $artType;
    }
}