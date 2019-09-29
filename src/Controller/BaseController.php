<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Service\FetchDataServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class BaseController extends AbstractController
{
    private $serializer;
    public $CUDService;
    public $FDService;


    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(CreateUpdateDeleteServiceInterface $CUDService, SerializerInterface $serializer, EntityManagerInterface $em,FetchDataServiceInterface $FDService)
    {
        $this->serializer = $serializer;
        $this->CUDService = $CUDService;
        $this->FDService=$FDService;
        $this->em = $em;
    }

    const STATE_OK = 200;
    const CREATE = "created";
    const UPDATE="updated";
    const DELETE="deleted";
    const FETCH="fetched";

    /**
     * Returns a JSON response
     *
     * @param array $data
     * @param array $headers
     *
     * @return JsonResponse
     */
    public function respond($data, $headers = [])
    {
        return new JsonResponse($data, self::STATE_OK, $headers);
    }

    /**
     * Sets an error message and returns a JSON response
     *
     * @param string $errors
     *
     * @param array $headers
     * @return JsonResponse
     */
    public function respondWithErrors($errors, $headers = [])
    {
        $data = [
            'errors' => $errors,
        ];

        return new JsonResponse($data, $this->getStatusCode(), $headers);
    }

    /**
     * Returns a 401 Unauthorized http response
     *
     * @param string $message
     *
     * @return JsonResponse
     */
    public function respondUnauthorized($message = 'Not authorized!')
    {
        return $this->setStatusCode(401)->respondWithErrors($message);
    }

    public function response($result, $status,$entity) :jsonResponse
    {
//        switch ($entity) {
//            case "Painting":
//        $result = $this->serializer->serialize($result, "json");
//              break;
//            case "Image"or"Video":
//                $result = $this->serializer->serialize($result, "json", ['ignored_attributes' => ['artist','painting','addingDate']
//                ] ,['groups' => ['default']]);
//                break;
//            default:
                $result = $this->serializer->serialize($result, "json", [
                    'enable_max_depth' => true]);
        //}
        $response = new jsonResponse(["status_code" => "200",
            "msg" => $status. " "."Successfully.",
            "Data" => json_decode($result)
            ]
        , Response::HTTP_OK);
        $response->headers->set('Access-Control-Allow-Headers', 'X-Header-One,X-Header-Two');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}
