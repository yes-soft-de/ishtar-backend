<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\PaintingValidate;
use App\Validator\PaintingValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintingController extends BaseController
{
    /**
     * @Route("/createPainting", name="createPainting")
     * @param Request $request
     * @return
     */
    public function create(Request $request, PaintingValidateInterface $paintingValidate)
    {
        //Validation
        $validateResult = $paintingValidate->paintingValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "Painting");
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/updatePainting", name="updatePainting")
     * @param Request $request
     * @return
     */
    public function update(Request $request, PaintingValidateInterface $paintingValidate)
    {
        $validateResult = $paintingValidate->paintingValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "Painting");
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/deletePainting", name="deletePainting")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, PaintingValidateInterface $paintingValidate)
    {
        $validateResult = $paintingValidate->paintingValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "Painting");
        return $this->response($result, self::DELETE);

    }
}
