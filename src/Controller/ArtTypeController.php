<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\CreateArtTypeRequest;
use App\Service\ArtTypeService;
use App\Validator\ArtTypeValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtTypeController extends BaseController
{
    private $artTypeService;
    private $autoMapping;
    /**
     * ArtistController constructor.
     * @param ArtTypeService $artTypeService
     */
    public function __construct(ArtTypeService $artTypeService,AutoMapping $autoMapping)
    {
        $this->artTypeService=$artTypeService;
        $this->autoMapping=$autoMapping;
    }

    /**
     * @Route("/arttypes", name="createArtType",methods={"POST"})
     * @param Request $request
     * @param ArtTypeValidateInterface $artTypeValidate
     * @return JsonResponse|Response
     */
    public function create(Request $request, ArtTypeValidateInterface $artTypeValidate)
    {
        //Validation
        $validateResult = $artTypeValidate->artTypeValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,CreateArtTypeRequest::class,(object)$data);
        $result = $this->artTypeService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/arttype/{id}", name="updateArttype",methods={"PUT"})
     * @param Request $request
     * @param ArtTypeValidateInterface $artTypeValidate
     * @return JsonResponse|Response
     */
    public function update(Request $request, ArtTypeValidateInterface $artTypeValidate)
    {
        $validateResult = $artTypeValidate->artTypeValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->artTypeService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/arttype/{id}", name="deleteArtType",methods={"DELETE"})
     * @param Request $request
     * @param ArtTypeValidateInterface $artTypeValidate
     * @return JsonResponse|Response
     */
    public function delete(Request $request, ArtTypeValidateInterface $artTypeValidate)
    {
        $validateResult = $artTypeValidate->artTypeValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->artTypeService->delete($request);
        return $this->response($result, self::DELETE);
    }

    /**
     * @Route("/arttypes", name="getAllArtTYpe",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getAll(Request $request)
    {
        $result = $this->artTypeService->getAll();
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/arttype/{id}", name="getArtTypeById",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getArtTypeById(Request $request)
    {
        $result = $this->artTypeService->getArtTypeById($request);
        return $this->response($result,self::FETCH);
    }
}
