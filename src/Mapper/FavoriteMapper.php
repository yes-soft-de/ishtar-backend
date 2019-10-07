<?php

namespace App\Mapper;

use App\Entity\ClientEntity;
use App\Entity\FavoriteEntity;
use App\Entity\Entity;
use App\Entity\PaintingEntity;
use DateTime;
use Exception;

class FavoriteMapper
{
    private $en;
    public function favoriteData($data, FavoriteEntity $favoriteEntity,$entityManger)
    {
        $this->en=$entityManger;
        $client = $this->en->getRepository(ClientEntity::class)->find($data["client"]);
        $painting = $this->en->getRepository(PaintingEntity::class)->find($data["painting"]);


        $favoriteEntity
            ->setClient($client)
            ->setPainting($painting);

        return $favoriteEntity;
    }
}