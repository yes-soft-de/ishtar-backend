<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\ImageValidate;
use App\Validator\ImageValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends BaseController
{
    /**
     * @Route("/createImage", name="createImage")
     * @param Request $request
     * @return
     */
    public function create(Request $request, ImageValidateInterface $imageValidate)
    {
        //Validation
        $validateResult = $imageValidate->imageValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "Image");
        return $this->response($result, self::CREATE, "Image");
    }

    /**
     * @Route("/updateImage", name="updateImage")
     * @param Request $request
     * @return
     */
    public function update(Request $request, ImageValidateInterface $imageValidate)
    {
        $validateResult = $imageValidate->imageValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "Image");
        return $this->response($result, self::UPDATE, "Image");
    }

    /**
     * @Route("/deleteImage", name="deleteImage")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, ImageValidateInterface $imageValidate)
    {
        $validateResult = $imageValidate->imageValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "Image");
        return $this->response($result, self::DELETE,"Image");

    }


    /**
     * @Route("/getAllImage",name="getAllImage")
     *@param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Image");
        return $this->response($result,self::FETCH,"Image");
    }
/**
* @Route("/getPaintingImages",name="getPaintingImages")
*@param Request $request
* @return
*/
    public function getPaintingImages(Request $request)
    {
        $result = $this->FDService->getPaintingImages($request);
        return $this->response($result,self::FETCH,"Image");
    }
}
