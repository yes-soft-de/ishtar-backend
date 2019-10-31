<?php


namespace App\Service;


use App\Manager\EntityArtTypeManager;
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

    public function __construct(PaintingManager $manager,EntityArtTypeManager $artTypeManager,PriceManager $priceManager
    ,StoryManager $storyManager)
    {
        $this->PaintingManager=$manager;
        $this->artTypeManager=$artTypeManager;
        $this->priceManager=$priceManager;
        $this->storyManager=$storyManager;
    }

    public function create($request)
    {
        $paintingResult =$this->PaintingManager->create($request);
        $artTypeResult=$this->artTypeManager->create($request,1);
        $priceData=$this->priceManager->create($request,1);
        $storyData=$this->storyManager->create($request,1);
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
    }
    public function getArtistPaintings(Request $request)
    {
        return $result = $this->PaintingManager->getArtistPaintings($request);
    }

    public function getPaintingById($id)
    {
        return $result = $this->PaintingManager->getPaintingById($id);
    }

    public function getPaintingImages(Request $request)
    {
        return $result = $this->PaintingManager->getPaintingImages($request);
    }
    public function getArtTypePaintings(Request $request)
    {
        return $result = $this->PaintingManager->getArtTypePaintings($request);
    }
    public function getBy(Request $request)
    {
        return $result = $this->PaintingManager->getBy($request);
    }


}