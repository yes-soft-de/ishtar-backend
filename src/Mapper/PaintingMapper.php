<?php

namespace App\Mapper;

use App\Entity\ArtistEntity;
use App\Entity\ArtType;
use App\Entity\ArtTypeEntity;
use App\Entity\EntityArtTypeEntity;
use App\Entity\GalleryEntity;
use App\Entity\PaintingEntity;
use App\Entity\PriceEntity;
use App\Repository\GalleryEntityRepository;
use DateTime;
use Doctrine\ORM\Mapping\Entity;
use Exception;
use phpDocumentor\Reflection\Types\This;

class PaintingMapper
{
    private $en;
    public function PaintingData($data, PaintingEntity $painting,$entityManger)
    {
        $PaintingArtType=new EntityArtTypeEntity();
        $PaintingPrice=new PriceEntity();
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
        $price = $data["price"];
        $story = $data["story"];
        $image = $data["image"];
        $active = $data["active"];
       // $createdBy = $data["createdBy"];
      // $updatedBy = $data["updatedBy"];
        $artType = $data["artType"];

        $painting->setName($name)
            ->setArtist($artist)
            ->setCreateDate($createDate)
            ->setStory($story)
            ->setState($state)
            ->setHeight($height)
            ->setWidth($width)
            ->setColorsType($colorsType)
            ->setActive($active)
           // ->setCreatedBy($createdBy)
          //  ->setUpdetedBy($updatedBy)
          // ->setGallery($gallery)
            ->setImage($image)
            ->setUpdateDate($updateDate);

        return $painting;
    }
}