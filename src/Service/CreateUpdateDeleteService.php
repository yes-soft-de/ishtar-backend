<?php


namespace App\Service;


use App\Manager\CreateUpdateDeleteManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreateUpdateDeleteService implements CreateUpdateDeleteServiceInterface
{
    //ToDo use BaseController for response things
    //ToDo mapping the correct response based on the entity

    private $manager;
    private $serializer;

    public function __construct(CreateUpdateDeleteManagerInterface $manager, SerializerInterface $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }

    public function create(Request $request, $entity)
    {
        $result = $this->manager->create($request, $entity);

        return $this->response($result, "Created");
    }

    public function update(Request $request, $entity)
    {
        $result = $this->manager->update($request, $entity);

        return $this->response($result, "Updated");
    }

    public function delete(Request $request, $entity)
    {
        $this->manager->delete($request, $entity);

        $response = new jsonResponse([
                "status_code" => "200",
                "msg" => "  deleted Successfully."
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
                "msg" => "  ".$status."Successfully.",
                "artist" => json_encode($result)
            ]
            , Response::HTTP_OK);

        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

}