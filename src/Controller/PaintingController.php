<?php

namespace App\Controller;

use App\Validator\PaintingValidateInterface;
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

       // Validation
        $validateResult = $paintingValidate->paintingValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->create($request, "Painting");
        $this->CUDService->create($request,"PaintingArtType");
        $this->CUDService->create($request,"Price");
        $this->CUDService->create($request,"Story");
        return $this->response($result, self::CREATE,"Painting");
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
        $this->CUDService->update($request,"PaintingArtType");
        $this->CUDService->create($request,"Price");
        $this->CUDService->update($request,"Story");
        return $this->response($result, self::UPDATE,"Painting");
    }

    /**
     * @Route("/deletePainting", name="deletePainting")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, PaintingValidateInterface $paintingValidate)
   {
//        $validateResult = $paintingValidate->paintingValidator($request, 'delete');
//        if (!empty($validateResult))
//        {
//            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
//            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
//            return $resultResponse;
//        }
        $this->CUDService->delete($request,"Price");
        $result = $this->CUDService->delete($request, "Painting");

        return $this->response($result, self::DELETE,"Painting");

    }

    /**
     * @Route("/getAllPainting", name="getAllPainting")
     * @param Request $request
     * @return
     */

    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Painting");
        return $this->response($result,self::FETCH,"Painting");
    }

    /**
     * @Route("/getArtistPaintings", name="getArtistPaintings")
     * @param Request $request
     * @return
     */
public function getArtistPaintings(Request $request)
{
    $result = $this->FDService->getArtistPaintings($request);
    return $this->response($result,self::FETCH,"Painting");
}

    /**
     * @Route("/getArtTypePaintings", name="getArtTypePaintings")
     * @param Request $request
     * @return
     */
    public function getArtTypePaintings(Request $request)
    {
        $result = $this->FDService->getArtTypePaintings($request);
        return $this->response($result,self::FETCH,"Painting");
    }

    /**
     * @Route("/getPaintingById", name="getPaintingById")
     * @param Request $request
     * @return
     */
    public function getPaintingById(Request $request)
    {
        $result = $this->FDService->getPaintingById($request);
        return $this->response($result,self::FETCH,"Painting");
    }
    /**
     * @Route("/getBy", name="getBy")
     * @param Request $request
     * @return
     */
    public function getBy(Request $request)
    {
        $result = $this->FDService->getBy($request);
        return $this->response($result,self::FETCH,"Painting");
    }

    /**
     * @Route("/getPaintingShort", name="getPaintingShort")
     * @param Request $request
     * @return
     */
    public function getPaintingShort()
    {
        $result = $this->FDService->getPaintingShort();
        return $this->response($result,self::FETCH,"Painting");
    }

    /**
     * @Route("/getPaintingImages", name="getPaintingImages")
     * @param Request $request
     * @return
     */
    public function getPaintingImages(Request $request)
    {
        $result = $this->FDService->getPaintingImages($request);
        return $this->response($result,self::FETCH,"Painting");
    }

}
