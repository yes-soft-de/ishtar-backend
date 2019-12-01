<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\FavoriteEntity;
use App\Manager\FavoriteManager;
use App\Manager\PriceManager;
use App\Response\CreateFavoriteResponse;
use App\Response\DeleteResponse;
use App\Response\GetFavoriteResponse;

class FavoriteService implements FavoriteServiceInterface
{
    private $FavoriteManager;
    private $priceManager;
    private $autoMapping;

    public function __construct(FavoriteManager $manager,PriceManager $priceManager,AutoMapping $autoMapping)
    {
        $this->FavoriteManager=$manager;
        $this->priceManager=$priceManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $result =$this->FavoriteManager->create($request);
        $response=$this->autoMapping->map(FavoriteEntity::class,CreateFavoriteResponse::class,$result);
        return $response;
    }
    public function update($request)
    {
        $result =$this->FavoriteManager->update($request);
        $response=$this->autoMapping->map(FavoriteEntity::class,CreateFavoriteResponse::class,$result);
        return $response;
    }
    public function getAll()
    {
        $result=$this->FavoriteManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        $result=$this->FavoriteManager->delete($request);
        $response=new DeleteResponse($result->getId());
        return $response;

    }

    public function getClientFavorite($request)
    {
         $result = $this->FavoriteManager->getClientFavorite($request);
         foreach ($result as $row)
             $response[]=$this->autoMapping->map('array',GetFavoriteResponse::class,$row);
         return $response;
    }

}