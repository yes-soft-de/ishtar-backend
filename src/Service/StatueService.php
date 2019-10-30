<?php


namespace App\Service;


use App\Manager\EntityArtTypeManager;
use App\Manager\StatueManager;
use App\Manager\PriceManager;
use App\Manager\StoryManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class StatueService implements StatueServiceInterface
{
    private $StatueManager;
    private $priceManager;

    public function __construct(StatueManager $manager,PriceManager $priceManager)
    {
        $this->StatueManager=$manager;
        $this->priceManager=$priceManager;
    }

    public function create($request)
    {
        $statueResult =$this->StatueManager->create($request);
        $priceData=$this->priceManager->create($request,6);
        return $statueResult;
    }
    //ToDO mapping statue entity and response
    public function update($request)
    {
        $statueResult =$this->StatueManager->update($request);
        $priceData=$this->priceManager->update($request,6);
        return $statueResult;
    }
    public function getAll()
    {
        $result=$this->StatueManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        return$result=$this->StatueManager->delete($request);
    }

    public function getStatueById($request)
    {
        return $result = $this->StatueManager->getStatueById($request);
    }

}