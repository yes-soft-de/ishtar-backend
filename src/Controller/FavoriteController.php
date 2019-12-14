<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\ByIdRequest;
use App\Request\CreateFavoriteRequest;
use App\Request\DeleteRequest;
use App\Request\UpdateFavoriteRequest;
use App\Service\FavoriteService;
use App\Validator\FavoriteValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends BaseController
{
    private $favoriteService;
    private $autoMapping;

    public function __construct(FavoriteService $favoriteService,AutoMapping $autoMapping)
    {
        $this->autoMapping=$autoMapping;
        $this->favoriteService=$favoriteService;
    }

    /**
     * @Route("/favorites", name="createFavorite",methods={"POST"})
     * @param Request $request
     * @param FavoriteValidateInterface $favoriteValidate
     * @return JsonResponse|Response
     */
    public function create(Request $request, FavoriteValidateInterface $favoriteValidate)
    {
        $validateResult = $favoriteValidate->favoriteValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $data = json_decode($request->getContent(), true);
        $data=(object)$data;
        $request=$this->autoMapping->map(\stdClass::class,CreateFavoriteRequest::class,$data);
        $result = $this->favoriteService->create($request);
        return $this->response($result, self::CREATE);
    }

    /*
     * @Route("/favorite/{id}" , name="updateFavorite", methods={"PUT"})
     * @param Request $request
     * @param FavoriteValidateInterface $favoriteValidate
     * @return JsonResponse|Response
     */
    public function update(Request $request, FavoriteValidateInterface $favoriteValidate)
    {
        $validateResult = $favoriteValidate->favoriteValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $id=$request->get('id');

        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,UpdateFavoriteRequest::class,(object)$data);
        $request->setId($id);
        $result = $this->favoriteService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/favorite/{id}", name="deleteFavorite",methods={"DELETE"})
     * @param Request $request
     * @param FavoriteValidateInterface $favoriteValidate
     * @return JsonResponse|Response
     */
    public function delete(Request $request, FavoriteValidateInterface $favoriteValidate)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->favoriteService->delete($request);
        return $this->response($result, self::DELETE);

    }

    /**
     * @Route("/favoritesclient/{id}",name="getClientFavorite",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getClientFavorite(Request $request)
    {
        $request=new ByIdRequest($request->get('id'));
        $result = $this->favoriteService->getClientFavorite($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/favorites",name="getAllFavorite",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $result = $this->favoriteService->getAll();
        return $this->response($result,self::FETCH);
    }

}
