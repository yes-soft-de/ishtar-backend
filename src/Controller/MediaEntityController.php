<?php

namespace App\Controller;

use App\Service\EntityMediaService;
use App\Validator\CommentValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaEntityController extends BaseController
{
    private $mediaService;

    /**
     * MediaEntityController constructor.
     * @param $mediaService
     */
    public function __construct(EntityMediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    /**
     * @Route("/medias", name="createMedia",methods={"POST"})
     * @param Request $request
     * @return
     */
    public function create(Request $request)
    {

        $result = $this->mediaService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     *@Route("/media/{id}", name="updateMedia",methods={"PUT"})
     * @param Request $request
     * @return
     */
    public function update(Request $request)
    {
        $result = $this->mediaService->update($request);
        return $this->response($result, self::UPDATE, "MediaEntity");
    }

    /**
     *  @Route("/media/{id}", name="deleteMedia",methods={"DELETE"})
     * @param Request $request
     * @return
     */
    public function delete(Request $request)
    {
        $result = $this->mediaService->delete($request);
        return $this->response($result, self::DELETE,"MediaEntity");

    }


    /**
     * @Route("/medias", name="getAllMedia",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->mediaService->getAll($request);
        return $this->response($result,self::FETCH,"Comment");
    }
    /**
     * @Route("entityitems/{entity}", name="getEntityItems",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getEntityItem(Request $request)
    {

        $result = $this->mediaService->getEntityItems($request,"Comment");
        return $this->response($result,self::FETCH,"Comment");
    }
}
