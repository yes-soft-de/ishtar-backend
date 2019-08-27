<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use App\Validator\ArtistArtTypeValidate;
use App\Validator\ArtistArtTypeValidateInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistArtTypeController extends BaseController
{
    /**
     * @Route("/createArtistArtType", name="createArtistArtType")
     * @param Request $request
     * @return
     */
    public function create(Request $request, ArtistArtTypeValidateInterface $artistArtTypeValidate)
    {
        //Validation
        $validateResult = $artistArtTypeValidate->artistArtTypeValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "ArtistArtType");
        return $this->response($result, self::CREATE, "ArtistArtType");
    }

    /**
     * @Route("/updateArtistArtType", name="updateArtistArtType")
     * @param Request $request
     * @return
     */
    public function update(Request $request, ArtistArtTypeValidateInterface $artistArtTypeValidate)
    {
        $validateResult = $artistArtTypeValidate->artistArtTypeValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "ArtistArtType");
        return $this->response($result, self::UPDATE, "ArtistArtType");
    }

    /**
     * @Route("/deleteArtistArtType", name="deleteArtistArtType")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, ArtistArtTypeValidateInterface $artistArtTypeValidate)
    {
        $validateResult = $artistArtTypeValidate->artistArtTypeValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "ArtistArtType");
        return $this->response($result, self::DELETE, "ArtistArtType");

    }


    /**
     * @Route("/getAllArtistArtType",name="getAllArtistArtType")
     *@param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"ArtistArtType");
        return $this->response($result,self::FETCH,"ArtistArtType");
    }
}
