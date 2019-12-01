<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\ArtTypeEntity;
use App\Manager\ArtTypeManager;
use App\Manager\EntityMediaManger;
use App\Response\CreateArtTypeResponse;
use App\Response\DeleteResponse;
use App\Response\UpdateArtTypeResponse;

class ArtTypeService implements ArtTypeServiceInterface
{

    private $artTypeManager;
    private $mediaManager;
    private $autoMapping;

    public function __construct(ArtTypeManager $artTypeManager,EntityMediaManger $entityMediaManager,
                                AutoMapping $autoMapping)
    {
        $this->artTypeManager=$artTypeManager;
        $this->mediaManager=$entityMediaManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $artTypeResult =$this->artTypeManager->create($request);
        $artTypeId=$artTypeResult->getId();
        $mediaResault=$this->mediaManager->create($request,3,$artTypeId);
        $response=$this->autoMapping->map(ArtTypeEntity::class,CreateArtTypeResponse::class,$artTypeResult);
        $response->setImage($mediaResault->getPath());
        return $response;
    }
    public function update($request)
    {
        $artTypeResult =$this->artTypeManager->update($request);
        $mediaResault=$this->mediaManager->update($request,3);
        $response=$this->autoMapping->map(ArtTypeEntity::class,UpdateArtTypeResponse::class,$artTypeResult);
        $response->setImage($mediaResault->getPath());
        return $response;
    }
    public function getAll()
    {
        $result=$this->artTypeManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        $result=$this->artTypeManager->delete($request);
        $this->mediaManager->delete($request,3);
        $response=new DeleteResponse($result->getId());
        return $response;
    }

    public function getArtTypeById($request)
    {
        return $result = $this->artTypeManager->getArtTypeById($request);
    }

}