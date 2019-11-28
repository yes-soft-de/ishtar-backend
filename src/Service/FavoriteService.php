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
        return $favoriteResult;
    }
    public function update($request)
    {
        $favoriteResult =$this->FavoriteManager->update($request);
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
        return $result;
    }

    public function getClientFavorite($request)
    {
        return $result = $this->FavoriteManager->getClientFavorite($request);
    }

}