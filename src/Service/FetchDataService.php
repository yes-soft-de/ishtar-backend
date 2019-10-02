<?php


namespace App\Service;

use App\Manager\CreateUpdateDeleteManagerInterface;
use App\Manager\FetchDataMangerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class FetchDataService implements FetchDataServiceInterface
{

    private $manager;
    private $serializer;

    public function __construct(FetchDataMangerInterface $manager, SerializerInterface $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }

    public function fetchData(Request $request, $entity)
    {
        return $result = $this->manager->fetchData($request, $entity);
    }

    public function response($result, $status): jsonResponse
    {
        $result = $this->serializer->serialize($result, "json");

        $response = new jsonResponse([
                "status_code" => "200",
                "msg" => "  " . $status . "Successfully.",
                "artist" => json_encode($result)
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    public function getArtistPaintings(Request $request)
    {
        return $result = $this->manager->getArtistPaintings($request);
    }

    public function getPaintingById(Request $request)
    {
        return $result = $this->manager->getPaintingById($request);
    }

   public function getPaintingImages(Request $request)
    {
        return $result = $this->manager->getPaintingImages($request);
  }
    public function getArtistById(Request $request)
    {
        return $result = $this->manager->getArtistById($request);
    }

    public function getArtTypeById(Request $request)
    {
        return $result = $this->manager->getArtTypeById($request);
    }

    public function getClientById(Request $request)
    {
        return $result = $this->manager->getClientById($request);
    }

    public function getAuctionById(Request $request)
    {
        return $result = $this->manager->getAuctionById($request);
    }

    public function getArtTypePaintings(Request $request)
    {
        return $result = $this->manager->getArtTypePaintings($request);
    }

    public function getBy(Request $request)
    {
        return $result = $this->manager->getBy($request);
    }

    public function getPaintingShort()
    {
        return $result = $this->manager->getPaintingShort();
    }

    public function getArtTypeList()
    {
        return $result = $this->manager->getArtTypeList();
    }

    public function getArtistsData($request)
    {
        return $result = $this->manager->getArtistsData($request);

    }

    public function getEntityNames($request)
    {
        return $result = $this->manager->getEntityNames($request);

    }

    public function getEntityInteraction($request)
    {
        return $result = $this->manager->getEntityInteraction($request);
    }

    public function getEntityComment($request)
    {
        return $result = $this->manager->getEntityComment($request);
    }


    public function getEntityClap($request)
    {
        return $result = $this->manager->getEntityClap($request);
    }
    public function search($request)
    {
        return $result = $this->manager->search($request);
    }
    public function getInteraction($request)
    {
        return $result = $this->manager->getInteraction($request);
    }
    public function getClientFavorite($request)
    {
        return $result = $this->manager->getClientFavorite($request);
    }
}
