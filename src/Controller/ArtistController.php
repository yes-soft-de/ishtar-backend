<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ArtistValidateInterface;

class ArtistController extends BaseController
{
    /**
     * @Route("/createArtist", name="createArtist")
     * @param Request $request
     * @return
     */
    public function create(Request $request, ArtistValidateInterface $artistValidate)
    {
        //Validation
        $validateResult = $artistValidate->artistValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->CUDService->create($request, "Artist");
        return $this->response($result, self::CREATE,"Artist");
    }

    /**
     * @Route("/updateArtist", name="updateArtist")
     * @param Request $request
     * @return
     */
    public function update(Request $request, ArtistValidateInterface $artistValidate)
    {
        $validateResult = $artistValidate->artistValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->update($request, "Artist");
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/deleteArtist", name="deleteArtist")
     * @param Request $request
     * @return
     */
    public function delete(Request $request, ArtistValidateInterface $artistValidate)
    {
        $validateResult = $artistValidate->artistValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->CUDService->delete($request, "Artist");
        return $this->response($result, self::DELETE);

    }



    /**
     * @Route("/getAllArtist",name="getAllArtist)
     *  @param
     *
     * @return
     */
    public function getAll(Request $request)
    {
        //ToDo Call Validator

        $result = $this->FDService->fetchData($request,"Artist");
        return $this->response($result,self::FETCH,"Artist");
    }
}
