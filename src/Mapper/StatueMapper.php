<?php

namespace App\Mapper;

use App\Entity\ArtistEntity;
use App\Entity\StatueEntity;
use DateTime;
use Exception;

class StatueMapper
{
    private $en;
    public function StatueData($data, StatueEntity $statue,$entityManger)
    {
        $this->en=$entityManger;
        $name = $data["name"];
        $artist = $this->en->getRepository(ArtistEntity::class)->findOneById($data["artist"]);
        try {
            $createDate = new DateTime((string)$data["createDate"]);
        } catch (Exception $e) {
        }
        try {
            $updateDate = new DateTime((string)$data["updateDate"]);
        } catch (Exception $e) {
        }
        $length = $data["state"];
        $height = $data["height"];
        $width = $data["width"];
        $material = $data["material"];
        $image = $data['image'];
        $active = $data["active"];
        $keyWords = $data["keyWords"];
        $description=$data["description"];
        $style=$data["style"];
        $mediums=$data["mediums"];
        $features =$data["features"];
        $period=$data["period"];
        $weight=$data["weight"];
        $state=$data["state"];

        $statue->setName($name)
            ->setArtist($artist)
            ->setLength($length)
            ->setState($state)
            ->setHeight($height)
            ->setWidth($width)
            ->setMaterial($material)
            ->setWeight($weight)
            ->setActive($active)
            ->setImage($image)
            ->setFeatures($features)
            ->setPeriod($period)
            ->setStyle($style)
            ->setDescription($description)
            ->setMediums($mediums)
            ->setKeyWord($keyWords)
        ;
        return $statue;
    }
}