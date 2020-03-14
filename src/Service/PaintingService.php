<?php


namespace App\Service;


use App\AutoMapping;
use App\Entity\PaintingEntity;
use App\Manager\EntityArtTypeManager;
use App\Manager\InteractionsManager;
use App\Manager\PaintingManager;
use App\Manager\PriceManager;
use App\Manager\StoryManager;
use App\Response\CreatePaintingResponse;
use App\Response\DeleteResponse;
use App\Response\GetPaintingsResponse;
use App\Response\GetPaintingByIdResponse;
use App\Response\GetPaintingByResponse;
use App\Response\UpdatePaintingResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Stmt\If_;
use Symfony\Component\HttpFoundation\Request;

class PaintingService implements PaintingServiceInterface
{
    private $PaintingManager;
    private $artTypeManager;
    private $priceManager;
    private $storyManager;
    private $interasctionsManager;
    private $autoMapping;

    public function __construct(PaintingManager $manager,EntityArtTypeManager $artTypeManager,PriceManager $priceManager
    ,StoryManager $storyManager,InteractionsManager $interactionsManager,AutoMapping $autoMapping)
    {
        $this->PaintingManager=$manager;
        $this->artTypeManager=$artTypeManager;
        $this->priceManager=$priceManager;
        $this->storyManager=$storyManager;
        $this->interasctionsManager=$interactionsManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $paintingResult = $this->PaintingManager->create($request);
        $paintingId = $paintingResult->getId();

        $artTypeResult = $this->artTypeManager->create($request,1,$paintingId);

        $priceData = $this->priceManager->create($request,1,$paintingId);

        $storyData = $this->storyManager->create($request,1,$paintingId);

        $response = $this->autoMapping->map(PaintingEntity::class,CreatePaintingResponse::class, $paintingResult);
        $response->setArtType($artTypeResult->getArtType());
        $response->setPrice($priceData->getPrice());
        $response ->setStory($storyData->getStory());

        return $response;
    }

    //ToDO mapping painting entity and response
    public function update($request,$id)
    {
        $paintingResult =$this->PaintingManager->update($request);
        $artTypeResult=$this->artTypeManager->update($request,1);
        $priceData=$this->priceManager->update($request,1);
        $storyData=$this->storyManager->update($request,1);
        $response=$this->autoMapping->map(PaintingEntity::class,UpdatePaintingResponse::class,
            $paintingResult);
        $response->setArtType($artTypeResult->getArtType());
        $response->setPrice($priceData->getPrice());
        $response ->setStory($storyData->getStory());
        return $response;
    }

    public function getAll()
    {
        $response = [];
        $result = $this->PaintingManager->getAll();

        foreach ($result as $row)
        {
            $response[]=$this->autoMapping->map('array',GetPaintingsResponse::class,$row);
        }

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
        $response = $this->autoMapping->map('array', GetPaintingByIdResponse::class, $result[0]);
        $response->setArtType($result[1]['artType']);
        $i=2;
        if (isset($result[$i]))
        {
            for($i=2 ;$i<sizeof($result);$i++)
                $paintingImages[]=$result[$i];
                $response->setImages($paintingImages);
        }
        return $response;
    }

    public function getBy($request)
    {
        $result = $this->PaintingManager->getBy($request);
        foreach ($result as $row)
            $response[]=$this->autoMapping->map('array',GetPaintingByResponse::class,$row);
        return $response;
    }

    public function getAllFeaturedPaintings()
    {
        $response = [];
        $result=$this->PaintingManager->getAllFeaturedPaintings();

        foreach ($result as $row)
        {
            $response[]=$this->autoMapping->map('array',GetPaintingsResponse::class,$row);
        }

        return $response;
    }

    public function updateFeaturedPaintings($request)
    {
        $paintingResult =$this->PaintingManager->updateFeaturedPaintings($request);

        $response = $this->autoMapping->map(PaintingEntity::class,UpdatePaintingResponse::class,
            $paintingResult);

        return $response;
    }

    public function updatePaintingThumbImage($request)
    {
        $paintingResult =$this->PaintingManager->updatePaintingThumbImage($request);

        $response = $this->autoMapping->map(PaintingEntity::class,UpdatePaintingResponse::class,
            $paintingResult);

        return $response;
    }

    public function updatePaintingImageLink($request)
    {
        $paintingResult =$this->PaintingManager->updatePaintingImageLink($request);

        $response = $this->autoMapping->map(PaintingEntity::class,UpdatePaintingResponse::class,
            $paintingResult);

        return $response;
    }

   public function updatePaintingState($request)
   {
       return $this->PaintingManager->updatePaintingState($request);
   }

}