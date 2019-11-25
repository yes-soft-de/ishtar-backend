<?php


namespace App\Service;

use App\Entity\ArtistEntity;
use App\Manager\ArtistManager;
use App\Manager\EntityArtTypeManager;
use App\Manager\EntityMediaManger;
use App\Manager\InteractionsManager;
use App\Response\CreateArtistResponse;
use App\Response\DeleteResponse;
use App\Response\GetAllArtistResponse;
use App\Response\GetArtistByIdResponse;
use App\Response\GetArtistsDetailsResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Symfony\Component\HttpFoundation\Request;

class ArtistService implements ArtistServiceInterface
{
    private $artistManager;
    private $artTypeManager;
    private $mediaManager;
    private $interactionManager;

    public function __construct(ArtistManager $artistManager,EntityArtTypeManager $artTypeManager,EntityMediaManger
    $entityMediaManager,InteractionsManager $interactionManager)
    {
        $this->artistManager=$artistManager;
        $this->artTypeManager=$artTypeManager;
        $this->mediaManager=$entityMediaManager;
        $this->interactionManager=$interactionManager;
    }

    public function create($request)
    {
        $artistResult =$this->artistManager->create($request);
        $artistID=$artistResult->getId();
        $artTypeResult=$this->artTypeManager->create($request,2,$artistID);
        $mediaResault=$this->mediaManager->create($request,2,$artistID);
        $response=New CreateArtistResponse();
        $config = new AutoMapperConfig();
        $config->registerMapping(ArtistEntity::class, CreateArtistResponse::class);
        $mapper = new AutoMapper($config);
        $mapper->mapToObject($artistResult,$response);
        $response->setImage($mediaResault->getPath());
        $response->setArtType($artTypeResult->getId());
        return $response;
    }
    //ToDO mapping painting entity and response
    public function update($request)
    {
        $artistResult =$this->artistManager->update($request);
        $artTypeResult=$this->artTypeManager->update($request,2);
        $mediaResault=$this->mediaManager->update($request,2);
        $response=New CreateArtistResponse();
        $config = new AutoMapperConfig();
        $config->registerMapping(ArtistEntity::class, CreateArtistResponse::class);
        $mapper = new AutoMapper($config);
        $mapper->mapToObject($artistResult,$response);
        $response->setImage($mediaResault->getPath());
        $response->setArtType($artTypeResult->getId());
        return $response;
    }
    public function getAll()
    {
        $result=$this->artistManager->getAll();
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetAllArtistResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($result as $row)
       $response[]=$mapper->map($row,GetAllArtistResponse::class);
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
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetArtistByIdResponse::class);
        $mapper = new AutoMapper($config);
        $response=$mapper->map($result[0],GetArtistByIdResponse::class);
        $response->setArtType($result[1]['artType']);
        return $response;

    }

    public function search(Request $request)
    {
        return $result=$this->artistManager->search($request);
    }

    public function getAllDetails()
    {
        $result=$this->artistManager->getAllDetails();
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetArtistsDetailsResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($result as $row)
            $response[]=$mapper->map($row,GetArtistsDetailsResponse::class);
        return $response;
    }
}