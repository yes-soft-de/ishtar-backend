<?php


namespace App\Service;


use App\Manager\EntityArtTypeManager;
use App\Manager\InteractionsManager;
use App\Manager\PaintingManager;
use App\Manager\PriceManager;
use App\Manager\StoryManager;
use App\Response\DeleteResponse;
use App\Response\GetPaintingsResponse;
use App\Response\GetPaintingByIdResponse;
use App\Response\GetPaintingByResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PaintingService implements PaintingServiceInterface
{
    private $PaintingManager;
    private $artTypeManager;
    private $priceManager;
    private $storyManager;
    private $interasctionsManager;

    public function __construct(PaintingManager $manager,EntityArtTypeManager $artTypeManager,PriceManager $priceManager
    ,StoryManager $storyManager,InteractionsManager $interactionsManager)
    {
        $this->PaintingManager=$manager;
        $this->artTypeManager=$artTypeManager;
        $this->priceManager=$priceManager;
        $this->storyManager=$storyManager;
        $this->interasctionsManager=$interactionsManager;
    }

    public function create($request)
    {
        $paintingResult =$this->PaintingManager->create($request);
        $paintingId=$paintingResult->getId();
        $artTypeResult=$this->artTypeManager->create($request,1,$paintingId);
        $priceData=$this->priceManager->create($request,1,$paintingId);
        $storyData=$this->storyManager->create($request,1,$paintingId);
        return $paintingResult;
    }
    //ToDO mapping painting entity and response
    public function update($request,$id)
    {
        $paintingResult =$this->PaintingManager->update($request);
        $artTypeResult=$this->artTypeManager->update($request,1);
        $priceData=$this->priceManager->update($request,1);
        $storyData=$this->storyManager->update($request,1);
        return $paintingResult;
    }
    public function getAll()
    {
        $result=$this->PaintingManager->getAll();
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetPaintingsResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($result as $row)
            $response[]=$mapper->map($row,GetPaintingsResponse::class);
        return $response;
    }
    public function delete($id)
    {
         $result=$this->PaintingManager->delete($id);
         $this->artTypeManager->delete($id,1);
         $this->priceManager->delete($id,1);
         $this->storyManager->delete($id,1);
         $this->interasctionsManager->deleteInteractions($id,1);
         $this->interasctionsManager->deleteComments($id,1);
         $this->interasctionsManager->deleteClaps($id,1);
        $response=new DeleteResponse($result->getId());
         return $response;

    }

    public function getPaintingById($id)
    {
         $result = $this->PaintingManager->getPaintingById($id);
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetPaintingByIdResponse::class);
        $mapper = new AutoMapper($config);
        $response=$mapper->map($result[0],GetPaintingByIdResponse::class);
        $response->setArtType($result[1]['artType']);
        foreach ($result[2] as $image)
            $response->setImages($image);
        return $response;

    }
    

    public function getBy($request)
    {
        $result = $this->PaintingManager->getBy($request);
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetPaintingByResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($result as $row)
            $response[]=$mapper->map($row,GetPaintingByResponse::class);
        return $response;

    }


}