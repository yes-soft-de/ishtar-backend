<?php

namespace App\Controller;

use App\Service\ArtistService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ArtistValidateInterface;

class ArtistController extends BaseController
{
    private $artistService;
    /**
     * ArtistController constructor.
     */
    public function __construct(ArtistService $artistService)
    {
        $this->artistService=$artistService;
    }
    /**
     *@Route("/artists", name="createArtist",methods={"POST"})
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

        $result = $this->artistService->create($request);
        return $this->response($result, self::CREATE,"Artist");
    }

    /**
     * @Route("/artist/{id}", name="updateArtist",methods={"PUT"})
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
        $result = $this->artistService->update($request);
        return $this->response($result, self::UPDATE,"Artist");
    }

    /**
     *  @Route("/artist/{id}", name="deleteArtist",methods={"DELETE"})
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
        $result = $this->artistService->delete($request);
        return $this->response($result, self::DELETE,"Artist");

    }

    /**
     * @Route("/artists", name="getAllArtist",methods={"GET"})
     * @return
     */
    public function getAll(Request $request)
    {
        //ToDo Call Validator

        $result = $this->artistService->getAll($request);
        return $this->response($result,self::FETCH,"Artist");
    }

    /**
     * @Route("/artist/{id}", name="getArtistById",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getArtistById(Request $request)
    {
        $result = $this->artistService->getArtistById($request);
        return $this->response($result,self::FETCH,"Artist");
    }

    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function search(Request $request)
    {
        $result = $this->artistService->search($request);
        return $this->response($result,self::FETCH,"Artist");
    }

    /**
     * @Route("/artistsdetails", name="getAllArtistData",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getAllDetails()
    {
        $result = $this->artistService->getAllDetails();
        return $this->response($result,self::FETCH,"Artist");
    }
}
