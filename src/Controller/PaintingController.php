<?php

namespace App\Controller;
use App\Service\PaintingService;
use App\Validator\PaintingValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaintingController extends BaseController
{
    private $paintingService;
    /**
     * PaintingController constructor.
     */
    public function __construct(PaintingService $paintingService)
    {
        $this->paintingService=$paintingService;
    }
    /**
     *  @Route("/paintings", name="createPainting",methods={"POST"})
     * @param Request $request
     * @return
     */
    public function create(Request $request, PaintingValidateInterface $paintingValidate)
    {
        $validateResult = $paintingValidate->paintingValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->paintingService->create($request);
        return $this->response($result, self::CREATE,"Painting");
    }

    /**
     * @Route("/painting/{id}", name="updatePainting",methods={"PUT"})
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
        $id=$request->get('id');
        $result = $this->paintingService->update($request,$id);
        return $this->response($result, self::UPDATE,"Painting");
    }

    /**
     * @Route("/painting/{id}", name="deletePainting",methods={"DELETE"})
     * @param $id
     * @return
     */
    public function delete($id, PaintingValidateInterface $paintingValidate)
   {
//        $validateResult = $paintingValidate->paintingValidator($request, 'delete');
//        if (!empty($validateResult))
//        {
//            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
//            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
//            return $resultResponse;
//        }
       $result=$this->paintingService->delete($id);
    //    $result = $this->CUDService->delete($request, "Painting");

        return $this->response($result, self::DELETE,"Painting");

    }

    /**
     * @Route("/paintings", name="getAllPainting",methods={"GET"})
     * @param Request $request
     * @return
     */

    public function getAll()
    {

        $result = $this->paintingService->getAll();
        return $this->response($result,self::FETCH,"Painting");
    }

    /**
     * @Route("/painting/getArtistPaintings", name="getArtistPaintings",methods={"GET"})
     * @param Request $request
     * @return
     */
public function getArtistPaintings(Request $request)
{
    $result = $this->paintingService->getArtistPaintings($request);
    return $this->response($result,self::FETCH,"Painting");
}

    /**
     * @Route("/painting/getArtTypePaintings", name="getArtTypePaintings",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getArtTypePaintings(Request $request)
    {
        $result = $this->paintingService->getArtTypePaintings($request);
        return $this->response($result,self::FETCH,"Painting");
    }

    /**
     * @Route("/painting/{id}", name="getPaintingById",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getPaintingById(Request $request)
    {
        $result = $this->paintingService->getPaintingById($request->get('id'));
        return $this->response($result,self::FETCH,"Painting");
    }
    /**
     * @Route("/painting/getBy", name="getBy",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getBy(Request $request)
    {
        $result = $this->paintingService->getBy($request);
        return $this->response($result,self::FETCH,"Painting");
    }

    /**
     * @Route("/painting/getShort", name="getPaintingShort",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getPaintingShort()
    {
        $result = $this->paintingService->getPaintingShort();
        return $this->response($result,self::FETCH,"Painting");
    }

    /**
     * @Route("/painting/getImages", name="getPaintingImages",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getPaintingImages(Request $request)
    {
        $result = $this->paintingService->getPaintingImages($request);
        return $this->response($result,self::FETCH,"Painting");
    }

}
