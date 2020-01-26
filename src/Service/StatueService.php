<?php


namespace App\Service;


use App\AutoMapping;
use App\Entity\StatueEntity;
use App\Manager\EntityArtTypeManager;
use App\Manager\InteractionsManager;
use App\Manager\StatueManager;
use App\Manager\PriceManager;
use App\Manager\StoryManager;
use App\Response\CreateStatueResponse;
use App\Response\DeleteResponse;
use App\Response\GetStatuesResponse;
use App\Response\GetStatueByIdResponse;
use App\Response\UpdatePaintingResponse;
use App\Response\UpdateStatueResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class StatueService implements StatueServiceInterface
{
    private $StatueManager;
    private $priceManager;
    private $interactionsManager;
    private $autoMapping;

    public function __construct(StatueManager $manager,PriceManager $priceManager,
                                InteractionsManager $interactionsManager,AutoMapping $autoMapping)
    {
        $this->StatueManager=$manager;
        $this->priceManager=$priceManager;
        $this->interactionsManager=$interactionsManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $statueResult =$this->StatueManager->create($request);
        $statueId=$statueResult->getId();
        $priceData=$this->priceManager->create($request,6,$statueId);
        $response=$this->autoMapping->map(StatueEntity::class,CreateStatueResponse::class,$statueResult);
        $response->setPrice($priceData->getPrice());
        return $response;
    }
    //ToDO mapping statue entity and response
    public function update($request)
    {
        $statueResult =$this->StatueManager->update($request);
        $priceData=$this->priceManager->update($request,6);
        $response=$this->autoMapping->map(StatueEntity::class,UpdateStatueResponse::class,$statueResult);
        $response->setPrice($priceData->getPrice());
        return $response;
    }
    public function getAll()
    {
        $response = [];
        $result=$this->StatueManager->getAll();
        foreach ($result as $row)
        {
            $response[]=$this->autoMapping->map('array',GetStatuesResponse::class,$row);
        }

        return $response;
    }
    public function delete($request)
    {
        $result=$this->StatueManager->delete($request);
        $this->priceManager->delete($request,6);
        $this->interactionsManager->deleteClaps($request,6);
        $this->interactionsManager->deleteComments($request,6);
        $this->interactionsManager->deleteInteractions($request,6);
        $response=new DeleteResponse($result->getId());
        return $response;

    }

    public function getStatueById($request)
    {
        $result = $this->StatueManager->getStatueById($request);
        $response=$this->autoMapping->map('array',GetStatueByIdResponse::class,$result[0]);
        return $response;
    }

}