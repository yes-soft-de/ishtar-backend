<?php

namespace App\Mapper;

use App\Entity\ArtistEntity;
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
        $artist = $this->en->getRepository(ArtistEntity::class)->findOneById($data["artist"]);
      //  $gallery=$this->en->getRepository(GalleryEntity::class)->find($data["gallery"]);
        //this (try catch) just to make IDE happy, must use date calender in frontend
        //if date empty the date of today will be there
        try {
            $createDate = new DateTime((string)$data["createDate"]);
        } catch (Exception $e) {
        }
        try {
            $updateDate = new DateTime((string)$data["updateDate"]);
        } catch (Exception $e) {
        }
        $state = $data["state"];
        $height = $data["height"];
        $width = $data["width"];
        $colorsType = $data["colorsType"];
        $image = $data['image'];
       // $active = $data["active"];
        $keyWords = $data["keyWords"];

        $painting->setName($name)
            ->setArtist($artist)
            ->setkeyWords($keyWords)
            ->setState($state)
            ->setHeight($height)
            ->setWidth($width)
            ->setColorsType($colorsType)
            ->setActive(1)
            ->setImage($image);


        return $painting;
    }
}