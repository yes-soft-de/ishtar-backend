<?php


namespace App\Service;


use App\Manager\EntityArtTypeManager;
use App\Manager\FavoriteManager;
use App\Manager\PriceManager;
use App\Manager\StoryManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FavoriteService implements FavoriteServiceInterface
{
    private $FavoriteManager;
    private $priceManager;

    public function __construct(FavoriteManager $manager,PriceManager $priceManager)
    {
        $this->FavoriteManager=$manager;
        $this->priceManager=$priceManager;
    }

    public function create($request)
    {
        $favoriteResult =$this->FavoriteManager->create($request);
        $priceData=$this->priceManager->create($request,6);
        return $favoriteResult;
    }
    //ToDO mapping favorite entity and response
    public function update($request)
    {
        $favoriteResult =$this->FavoriteManager->update($request);
        $priceData=$this->priceManager->update($request,6);
        return $favoriteResult;
    }
    public function getAll()
    {
        $result=$this->FavoriteManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        $result=$this->FavoriteManager->delete($request);
        $this->priceManager->delete($request,6);
        return $result;
    }

    public function getById($request)
    {
        return $result = $this->FavoriteManager->getFavoriteById($request);
    }

}