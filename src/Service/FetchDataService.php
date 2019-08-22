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
        return $result = $this->manager->fetchData($request,$entity);
    }
    public function response($result, $status) :jsonResponse
    {
        $result =  $this->serializer->serialize($result, "json");

        $response = new jsonResponse([
                "status_code" => "200",
                "msg" => "  ".$status."Successfully.",
                "artist" => json_encode($result)
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
