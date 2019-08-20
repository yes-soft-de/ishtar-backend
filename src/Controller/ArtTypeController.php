<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\ArtTypeValidate;
use App\Validator\ArtTypeValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtTypeController extends BaseController
{
    /**
     * @Route("/createArtType", name="createArtType")
     * @param Request $request
     * @return
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
        //

        $result = $this->CUDService->create($request, "ArtType");
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/updateArtType", name="updateArtType")
     * @param Request $request
     * @return
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
        $result = $this->CUDService->update($request, "ArtType");
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/deleteArtType", name="deleteArtType")
     * @param Request $request
     * @return
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
        $result = $this->CUDService->delete($request, "ArtType");
        return $this->response($result, self::DELETE);

    }
}
