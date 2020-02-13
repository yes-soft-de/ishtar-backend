<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\ClapEntity;
use App\Manager\ClapManager;
use App\Response\CreateClapResponse;
use App\Response\DeleteResponse;
use App\Response\GetClapsClientResponse;
use App\Response\GetClapsEntityResponse;
use App\Response\GetClapsResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;

class ClapService implements ClapServiceInterface
{

    private $clapManager;
    private $autoMapping;
    public function __construct(ClapManager $clapManager,AutoMapping $autoMapping)
    {
        $this->clapManager=$clapManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $clapResult =$this->clapManager->create($request);
        $response=$this->autoMapping->map(ClapEntity::class,CreateClapResponse::class,$clapResult);
        return $response;
    }
    public function update($request)
    {
        $clapResult =$this->clapManager->update($request);
        $response=$this->autoMapping->map(ClapEntity::class,CreateClapResponse::class,$clapResult);
        return $response;
    }
    public function delete($request)
    {
        $result =$this->clapManager->delete($request);
        $response=new DeleteResponse($result->getId());
        return $response;
    }


    public function getEntityClap($request)
    {
        $response = [];

        $clapResult =$this->clapManager->getEntityClap($request);

        foreach ($clapResult as $row)
        {
            $response[]= $this->autoMapping->map('array',GetClapsEntityResponse::class,$row);
        }

        return $response;
    }

    public function getClientClap($request)
    {
        $response = [];

        $clapResult =$this->clapManager->getClientClap($request);

        foreach ($clapResult as $row)
        {
            $response[]= $this->autoMapping->map('array',GetClapsClientResponse::class,$row);
        }

        return $response;
    }

    public function getAll()
    {
        $response = [];

        $clapResult =$this->clapManager->getAll();

        foreach ($clapResult as $row)
        {
            $response[]=$this->autoMapping->map(ClapEntity::class,GetClapsResponse::class,$row);
        }

        return $response;
    }
}