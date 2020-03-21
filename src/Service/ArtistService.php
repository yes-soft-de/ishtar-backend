<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\ArtistEntity;
use App\Manager\ArtistManager;
use App\Manager\ClapManager;
use App\Manager\CommentManager;
use App\Manager\EntityArtTypeManager;
use App\Manager\EntityInteractionManager;
use App\Manager\EntityMediaManger;
use App\Manager\InteractionsManager;
use App\Request\GetInterctionEntityRequest;
use App\Response\CreateArtistResponse;
use App\Response\DeleteResponse;
use App\Response\GetAllArtistResponse;
use App\Response\GetArtistByIdResponse;
use App\Response\GetArtistsDetailsResponse;
use App\Response\UpdateArtistResponse;
use Symfony\Component\HttpFoundation\Request;

class ArtistService implements ArtistServiceInterface
{
    private $artistManager;
    private $artTypeManager;
    private $mediaManager;
    private $interactionManager;
    private $autoMapping;


    public function __construct(ArtistManager $artistManager,EntityArtTypeManager $artTypeManager,EntityMediaManger
    $entityMediaManager,InteractionsManager $interactionManager,AutoMapping $autoMapping)
    {
        $this->artistManager=$artistManager;
        $this->artTypeManager=$artTypeManager;
        $this->mediaManager=$entityMediaManager;
        $this->interactionManager=$interactionManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $artistResult =$this->artistManager->create($request);
        $artistID=$artistResult->getId();
        $artTypeResult=$this->artTypeManager->create($request,2,$artistID);
        $mediaResault=$this->mediaManager->create($request,2,$artistID);
        $response=$this->autoMapping->map(ArtistEntity::class,CreateArtistResponse::class,$artistResult);
        $response->setImage($mediaResault->getPath());
        $response->setArtType($artTypeResult->getArtType());
        $response->setThumbImage($mediaResault->getThumbImage());
        return $response;
    }

    //ToDO mapping painting entity and response
    public function update($request)
    {
        $artistResult =$this->artistManager->update($request);
        $artTypeResult=$this->artTypeManager->update($request,2);
        $mediaResault=$this->mediaManager->update($request,2);
        $response=$this->autoMapping->map(ArtistEntity::class,UpdateArtistResponse::class,$artistResult);
        $response->setImage($mediaResault->getPath());
        $response->setArtType($artTypeResult->getId());
        return $response;
    }

    public function getAll()
    {
        $response = [];

        $result=$this->artistManager->getAll();
        foreach ($result as $row)
        {
            $response[]=$this->autoMapping->map('array',GetAllArtistResponse::class,$row);
        }

        return $response;
    }
    public function delete($request)
    {
        $result=$this->artistManager->delete($request);
        $this->mediaManager->delete($request,2);
        $this->artTypeManager->delete($request,2);
        $this->interactionManager->deleteClaps($request,2);
        $this->interactionManager->deleteComments($request,2);
        $this->interactionManager->deleteInteractions($request,2);
        $response=new DeleteResponse($result->getId());
        return $response;
    }

    public function getArtistById($request)
    {
        $result = $this->artistManager->getArtistById($request);
        $response=$this->autoMapping->map('array',GetArtistByIdResponse::class,$result[0]);
        if(isset($result[1]['artType']))
        $response->setArtType($result[1]['artType']);
        return $response;
    }

    public function search(Request $request)
    {
        return $result=$this->artistManager->search($request);
    }

    public function getAllDetails()
    {
        $response = [];

        $result=$this->artistManager->getAllDetails();

        foreach ($result as $row)
        {
            $response[]=$this->autoMapping->map('array',GetArtistsDetailsResponse::class,$row);
        }

        return $response;
    }

}