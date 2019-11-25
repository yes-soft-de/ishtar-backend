<?php

namespace App\Controller;

use App\Service\FavoriteService;
use App\Validator\FavoriteValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends BaseController
{
    private $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
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
        //Validation
        $validateResult = $favoriteValidate->favoriteValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->favoriteService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**@Route("/favorite/{id}", name="updateFavorite",methods={"PUT"})
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
        $validateResult = $favoriteValidate->favoriteValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->favoriteService->delete($request);
        return $this->response($result, self::DELETE);

    }

    /**
     * @Route("/favoritesClient",name="getClientFavorite",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getClientFavorite(Request $request)
    {
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
