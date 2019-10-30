<?php

namespace App\Controller;

use App\Validator\FavoriteValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends BaseController
{
    /**
     * @Route("/favorites", name="createFavorite",methods={"POST"})
     * @param Request $request
     * @return
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
        //

        $result = $this->CUDService->create($request, "Favorite");
        return $this->response($result, self::CREATE, "Favorite");
    }

    /**@Route("/favorite/{id}", name="updateFavorite",methods={"PUT"})
     * @param Request $request
     * @return
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
        $result = $this->CUDService->update($request, "Favorite");
        return $this->response($result, self::UPDATE, "Favorite");
    }

    /**
     *  @Route("/favorite/{id}", name="deleteFavorite",methods={"DELETE"})
     * @param Request $request
     * @return
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
        $result = $this->CUDService->delete($request, "Favorite");
        return $this->response($result, self::DELETE,"Favorite");

    }


    /**
     * @Route("/getClientFavorite",name="getClientFavorite")
     * @param Request $request
     * @return
     */
    public function getClientFavorite(Request $request)
    {

        $result = $this->FDService->getClientFavorite($request);
        return $this->response($result,self::FETCH,"Favorite");
    }

}
