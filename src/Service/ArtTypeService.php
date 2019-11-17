<?php


namespace App\Service;

use App\Controller\ArtType;
use App\Manager\ArtTypeManager;
use App\Manager\CreateUpdateDeleteManagerInterface;
use App\Manager\EntityArtTypeManager;
use App\Manager\EntityMediaManger;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ArtTypeService implements ArtTypeServiceInterface
{

    private $artTypeManager;
    private $mediaManager;

    public function __construct(ArtTypeManager $artTypeManager,EntityMediaManger $entityMediaManager)
    {
        $this->artTypeManager=$artTypeManager;
        $this->mediaManager=$entityMediaManager;
    }

    public function create($request)
    {
        $artTypeResult =$this->artTypeManager->create($request);
        $artTypeId=$artTypeResult->getId();
        $mediaResault=$this->mediaManager->create($request,3,$artTypeId);
        return $artTypeResult;
    }
    public function update($request)
    {
        $artTypeResult =$this->artTypeManager->update($request);
        $mediaResault=$this->mediaManager->update($request,3);
        return $artTypeResult;
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
        return $result;
    }

    public function getArtTypeById($request)
    {
        return $result = $this->artTypeManager->getArtTypeById($request);
    }

}