<?php


namespace App\Service;


use App\Manager\ArtistManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class ArtistService implements ArtistServiceInterface
{
    private $artistManager;
    private $serializer;

    public function __construct(ArtistManagerInterface $artistManager, SerializerInterface $serializer)
    {
        $this->artistManager = $artistManager;
        $this->serializer = $serializer;
    }

    public function createPainting(Request $request, $entity)
    {
        $result = $this->artistManager->create($request, $entity);

        $result =  $this->serializer->serialize($result, "json");
        //$response = json_decode($result, true);

        //return response object
        return new jsonResponse([
            "status_code" => "200",
            "msg" => "Artist Created Successfully.",
            "artist" => json_encode($result)
        ]
            , Response::HTTP_OK);
    }

    public function updatePainting(Request $request, $entity)
    {
        $result = $this->artistManager->update($request, $entity);
        return [
            "status_code" => "200",
            "msg" => "Painting Updated Successfully.".$result
        ];
    }

    public function deletePainting(Request $request, $entity)
    {
        $result = $this->artistManager->delete($request, $entity);
        return [
            "status_code" => "200",
            "msg" => "Painting deleted Successfully.".$result
        ];
    }

}