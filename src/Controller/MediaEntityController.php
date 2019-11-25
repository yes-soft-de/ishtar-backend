<?php

namespace App\Controller;

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
     * @return JsonResponse
     * @throws UnregisteredMappingException
     */
    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, CreateMediaRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, CreateMediaRequest::class);
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
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, UpdateMediaRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, UpdateMediaRequest::class);
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
