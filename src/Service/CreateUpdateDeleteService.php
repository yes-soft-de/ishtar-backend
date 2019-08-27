<?php


namespace App\Service;

use App\Manager\CreateUpdateDeleteManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class CreateUpdateDeleteService implements CreateUpdateDeleteServiceInterface
{

    private $manager;
    private $serializer;

    public function __construct(CreateUpdateDeleteManagerInterface $manager, SerializerInterface $serializer)
    {
        $this->manager = $manager;
        $this->serializer = $serializer;
    }

    public function create(Request $request, $entity)
    {
        return $result = $this->manager->create($request, $entity);

        //return $this->response($result, "Created");
    }

    public function update(Request $request, $entity)
    {
       return $result = $this->manager->update($request, $entity);

       // return $this->response($result, "Updated"\);
    }


    public function delete(Request $request, $entity)
    {
      return  $this->manager->delete($request, $entity);

//        //Todo move this response to base controller and call it from here
//        $response = new jsonResponse([
//                "status_code" => "200",
//                "msg" => "  deleted Successfully."
//            ]
//            , Response::HTTP_OK);
//
//        $response->headers->set('Access-Control-Allow-Origin', '*');
//
//        return $response;
    }

    //ToDo we do not need this function any more it has been replaced by using baseController
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