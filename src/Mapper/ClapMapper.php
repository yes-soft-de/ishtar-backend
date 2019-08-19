<?php

namespace App\Mapper;

use App\Entity\ClapEntity;
use App\Entity\ClientEntity;

class ClapMapper
{ private $en;
    public function clapData($data, ClapEntity $clap,$entityManger)
    {
        $this->en=$entityManger;
        $pageName        = $data["pageName"];
        $rowNum = $data["rowNum"];
        $value   = $data["value"];
        $client = $this->en->getRepository(ClientEntity::class)->find($data["client"]);

        $clap->setPageName($pageName)
            ->setRowNum($rowNum)
            ->setValue($value)
            ->setClient($client);

        return $clap;
    }
}