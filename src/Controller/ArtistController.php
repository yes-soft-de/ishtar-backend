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
     * @return Response
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
        $this->CUDService->create($request,"ArtistArtType");
        $this->CUDService->create($request,"MediaArtist");
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
        return $this->response($result, self::UPDATE,"Artist");
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
        return $this->response($result, self::DELETE,"Artist");

    }



    /**
     * @Route("/getAllArtist",name="getAllArtist")
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {
        //ToDo Call Validator

        $result = $this->FDService->fetchData($request,"Artist");
        return $this->response($result,self::FETCH,"Artist");
    }

    /**
     * @Route("/getArtistById", name="getArtistById")
     * @param Request $request
     * @return
     */
    public function getArtistById(Request $request)
    {
        $result = $this->FDService->getArtistById($request);
        return $this->response($result,self::FETCH,"Artist");
    }
    /**
     * @Route("/getArtistsData",name="getArtistsData")
     * @param Request $request
     * @return
     */
    public function getArtistsData(Request $request)
    {

        $result = $this->FDService->getArtistsData($request,"Artist");
        return $this->response($result,self::FETCH,"Artist");
    }
    /**
     * @Route("/getArtistPaintings", name="getArtistPaintings")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function getArtistPaintings(Request $request)
    {

        $result = $this->FDService->getArtistsData($request,"Artist");
        return $this->response($result,self::FETCH,"Artist");
    }
}
