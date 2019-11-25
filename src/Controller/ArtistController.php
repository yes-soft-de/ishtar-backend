<?php

namespace App\Controller;

use App\Request\CreateArtistRequest;
use App\Request\DeleteRequest;
use App\Request\GetArtistRequest;
use App\Request\UpdateArtistRequest;
use App\Service\ArtistService;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ArtistValidateInterface;

class ArtistController extends BaseController
{
    private $artistService;

    /**
     * ArtistController constructor.
     * @param ArtistService $artistService
     */
    public function __construct(ArtistService $artistService)
    {
        $this->artistService = $artistService;
    }

    /**
     * @Route("/artists",name="createArtist",methods={"POST"})
     * @param Request $request
     * @param ArtistValidateInterface $artistValidate
     * @return Response
     * @throws UnregisteredMappingException
     */
    public function create(Request $request, ArtistValidateInterface $artistValidate)
    {
        //Validation
        $validateResult = $artistValidate->artistValidator($request, 'create');
        if (!empty($validateResult)) {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, CreateArtistRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, CreateArtistRequest::class);
        $result = $this->artistService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/artist/{id}", name="updateArtist",methods={"PUT"})
     * @param Request $request
     * @param ArtistValidateInterface $artistValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
     */
    public function update(Request $request, ArtistValidateInterface $artistValidate)
    {
        $validateResult = $artistValidate->artistValidator($request, 'update');
        if (!empty($validateResult)) {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, UpdateArtistRequest::class);
        $mapper = new AutoMapper($config);
        $id=$request->get('id');
        $request = $mapper->map((object)$data, UpdateArtistRequest::class);
        $request->setId($id);
        $result = $this->artistService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/artist/{id}", name="deleteArtist",methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->artistService->delete($request);
        return $this->response($result, self::DELETE);
    }

    /**
     * @Route("/artists", name="getAllArtist",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $result = $this->artistService->getAll();
        return $this->response($result, self::FETCH);
    }

    /**
     * @Route("/artist/{id}", name="getArtistById",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getArtistById(Request $request)
    {
        $request=new GetArtistRequest($request->get('id'));
        $result = $this->artistService->getArtistById($request);
        return $this->response($result, self::FETCH);
    }

    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function search(Request $request)
    {
        $result = $this->artistService->search($request);
        return $this->response($result, self::FETCH);
    }

    /**
     * @Route("/artistsdetails", name="getAllArtistData",methods={"GET"})
     *
     * @return
     */
    public function getAllDetails()
    {
        $result = $this->artistService->getAllDetails();
        return $this->response($result, self::FETCH);
    }
}