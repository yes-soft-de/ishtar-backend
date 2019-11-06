<?php


namespace App\Service;

use App\Controller\Artist;
use App\Manager\ArtistManager;
use App\Manager\ClapManager;
use App\Manager\CommentManager;
use App\Manager\CreateUpdateDeleteManagerInterface;
use App\Manager\EntityArtTypeManager;
use App\Manager\EntityInteractionManager;
use App\Manager\EntityMediaManger;
use App\Manager\InteractionsManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

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
        return $artistResult;
    }
    //ToDO mapping painting entity and response
    public function update($request)
    {
        $artistResult =$this->artistManager->update($request);
        $artTypeResult=$this->artTypeManager->update($request,2);
        $mediaResault=$this->mediaManager->update($request,2);
        return $artistResult;
    }
    public function getAll()
    {
        $result=$this->artistManager->getAll();
        return $result;
    }
    public function delete($request)
    {
        $result=$this->artistManager->delete($request);
        $this->mediaManager->delete($request,2);
        $this->artTypeManager->delete($request,2);
        $this->interactionManager->deleteClaps(2,$request);
        $this->interactionManager->deleteComments(2,$request);
        $this->interactionManager->deleteInteractions(2,$request);
        return $result;
    }

    public function getArtistById($request)
    {
        return $result = $this->artistManager->getArtistById($request);
    }

    public function search(Request $request)
    {
        return $result=$this->artistManager->search($request);
    }

    public function getAllDetails()
    {
        $result=$this->artistManager->getAllDetails();
        return $result;
    }
}