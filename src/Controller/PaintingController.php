<?php

namespace App\Controller;
use App\Request\ByIdRequest;
use App\Request\CreateArtistRequest;
use App\Request\CreatePaintingRequest;
use App\Request\getPaintingByRequest;
use App\Request\UpdatePaintingRequest;
use App\Service\PaintingService;
use App\Validator\PaintingValidateInterface;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
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
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, CreatePaintingRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, CreatePaintingRequest::class);
        $result = $this->paintingService->create($request);
        return $this->response($result, self::CREATE);
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
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, UpdatePaintingRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, UpdatePaintingRequest::class);
        $request->setId($id);
        $result = $this->paintingService->update($request,$id);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/painting/{id}", name="deletePainting",methods={"DELETE"})
     * @param Request $request
     * @return
     */
    public function delete(Request $request ,PaintingValidateInterface $paintingValidate)
   {

        $request=new ByIdRequest($request->get('id'));
       $result=$this->paintingService->delete($request);
        return $this->response($result, self::DELETE);

    }

    /**
     * @Route("/paintings", name="getAllPainting",methods={"GET"})
     *
     * @return
     */

    public function getAll()
    {
        $result = $this->paintingService->getAll();
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/painting/getArtistPaintings", name="getArtistPaintings",methods={"GET"})
     * @param Request $request
     * @return
     */
public function getArtistPaintings(Request $request)
{
    $request=new ByIdRequest($request->get('id'));
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
        $request=new ByIdRequest($request->get('id'));
        $result = $this->paintingService->getArtTypePaintings($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/painting/{id}", name="getPaintingById",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getPaintingById(Request $request)
    {
        $request=new ByIdRequest($request->get('id'));
        $result = $this->paintingService->getPaintingById($request->getId());
        return $this->response($result,self::FETCH,"Painting");
    }
    /**
     *  @Route("/paintingby/{parm}/{value}", name="getPaintingBy",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getBy(Request $request)
    {
        $request=new GetPaintingByRequest($request->get('parm'),$request->get('value'));
        $result = $this->paintingService->getBy($request);
        return $this->response($result,self::FETCH,"Painting");
    }
    
}
