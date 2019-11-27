<?php


namespace App\Service;


use App\Entity\StatueEntity;
use App\Manager\EntityArtTypeManager;
use App\Manager\InteractionsManager;
use App\Manager\StatueManager;
use App\Manager\PriceManager;
use App\Manager\StoryManager;
use App\Response\GetStatuesResponse;
use App\Response\GetStatueByIdResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
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
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetStatuesResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($result as $row)
            $response[]=$mapper->map($row,GetStatuesResponse::class);
        return $response;
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
        $result = $this->StatueManager->getStatueById($request);
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetStatueByIdResponse::class);
        $mapper = new AutoMapper($config);
        $response=$mapper->map($result[0],GetStatueByIdResponse::class);
        return $response;
    }

}