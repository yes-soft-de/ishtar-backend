<?php


namespace App\Service;


use App\Manager\EntityArtTypeManager;
use App\Manager\InteractionsManager;
use App\Manager\PaintingManager;
use App\Manager\PriceManager;
use App\Manager\StoryManager;
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
        return $result;
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
         return $result;

    }

    public function getPaintingById($id)
    {
        return $result = $this->PaintingManager->getPaintingById($id);
    }
    

    public function getBy($request)
    {

        return $result = $this->PaintingManager->getBy($request);
    }


}