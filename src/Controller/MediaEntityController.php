<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\ByIdRequest;
use App\Request\CreateMediaRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateMediaRequest;
use App\Service\EntityMediaService;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MediaEntityController extends BaseController
{
    private $mediaService;
    private $autoMapping;

    /**
     * MediaEntityController constructor.
     * @param $mediaService
     */
    public function __construct(EntityMediaService $mediaService,AutoMapping $autoMapping)
    {
        $this->mediaService = $mediaService;
        $this->autoMapping=$autoMapping;
    }

    /**
     * @Route("/medias", name="createMedia",methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     * @throws UnregisteredMappingException
     */
    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,CreateMediaRequest::class,(object)$data);
        $result = $this->mediaService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/media/{id}", name="updateMedia",methods={"PUT"})
     * @param Request $request
     * @return JsonResponse
     * @throws UnregisteredMappingException
     */
    public function update(Request $request)
    {
        $id=$request->get('id');
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,UpdateMediaRequest::class,(object)$data);
        $request->setId($id);
        $result = $this->mediaService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/media/{id}", name="deleteMedia",methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
     */
    public function delete(Request $request)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->mediaService->delete($request);
        return $this->response($result, self::DELETE);

    }

    /**
     * @Route("/medias", name="getAllMedia",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $result = $this->mediaService->getAll();
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("entityitems/{entity}", name="getEntityItems",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getEntityItem(Request $request)
    {
        $request=new ByIdRequest($request->get('entity'));
        $result = $this->mediaService->getEntityItems($request);
        return $this->response($result,self::FETCH);
    }
}
