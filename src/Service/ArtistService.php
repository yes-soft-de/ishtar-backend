<?php


namespace App\Service;


use App\Manager\CreateUpdateDeleteManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ArtistService implements ArtistServiceInterface
{
    private $artistManager;
    private $serializer;

    public function __construct(CreateUpdateDeleteManagerInterface $artistManager, SerializerInterface $serializer)
    {
        $this->artistManager = $artistManager;
        $this->serializer = $serializer;
    }

    public function createArtist(Request $request, $entity)
    {
        $result = $this->artistManager->create($request, $entity);

        return $this->response($result, "Created");
    }

    public function updateArtist(Request $request, $entity)
    {
        $result = $this->artistManager->update($request, $entity);

        return $this->response($result, "Updated");
    }

    public function deleteArtist(Request $request, $entity)
    {
        $this->artistManager->delete($request, $entity);

        $response = new jsonResponse([
                "status_code" => "200",
                "msg" => "Artist deleted Successfully."
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    public function response($result, $status) :jsonResponse
    {
        $result =  $this->serializer->serialize($result, "json");

        $response = new jsonResponse([
                "status_code" => "200",
                "msg" => "Artist ".$status."Successfully.",
                "artist" => json_encode($result)
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

}