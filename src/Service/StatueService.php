<?php


namespace App\Service;


use App\Manager\EntityArtTypeManager;
use App\Manager\InteractionsManager;
use App\Manager\StatueManager;
use App\Manager\PriceManager;
use App\Manager\StoryManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class StatueService implements StatueServiceInterface
{
    private $StatueManager;
    private $priceManager;
    private $interactionsManager;

    public function __construct(StatueManager $manager,PriceManager $priceManager,InteractionsManager $interactionsManager)
    {
        $this->StatueManager=$manager;
        $this->priceManager=$priceManager;
        $this->interactionsManager=$interactionsManager;
    }

    public function create($request)
    {
        $statueResult =$this->StatueManager->create($request);
        $statueId=$statueResult->getId();
        $priceData=$this->priceManager->create($request,6,$statueId);
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
        $result=$this->StatueManager->delete($request);
        $this->priceManager->delete($request,6);
        $this->interactionsManager->deleteClaps($request,6);
        $this->interactionsManager->deleteComments($request,6);
        $this->interactionsManager->deleteInteractions($request,6);
        return $result;
    }

    public function getStatueById($request)
    {
        return $result = $this->StatueManager->getStatueById($request);
    }

}