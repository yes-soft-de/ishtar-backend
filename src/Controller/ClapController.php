<?php

namespace App\Controller;

use App\Service\ClapService;
use App\Validator\ClapValidateInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClapController extends BaseController
{
    private $clapService;

    /**
     * ClapController constructor.
     * @param $clapService
     */
    public function __construct(ClapService $clapService)
    {
        $this->clapService = $clapService;
    }

    /**
     * @Route("/claps", name="createClap",methods={"POST"})
     * @param Request $request
     * @return
     */
    public function create(Request $request, ClapValidateInterface $clapValidate)
    {
        //Validation
        $validateResult = $clapValidate->clapValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        //

        $result = $this->clapService->create($request);
        return $this->response($result, self::CREATE, "Clap");
    }

    /**
     * @Route("/clap/{id}", name="updateClap",methods={"PUT"})
     * @param Request $request
     * @return
     */
    public function update(Request $request, ClapValidateInterface $clapValidate)
    {
        $validateResult = $clapValidate->clapValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->clapService->update($request);
        return $this->response($result, self::UPDATE, "Clap");
    }

    /**
     *  @Route("/clap/{id}", name="deleteClap",methods={"DELETE"})
     * @param Request $request
     * @return
     */
    public function delete(Request $request, ClapValidateInterface $clapValidate)
    {
        $validateResult = $clapValidate->clapValidator($request, 'delete');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->clapService->delete($request);
        return $this->response($result, self::DELETE,"Clap");

    }


    /**
     * @Route("/clapsentity/{entity}/{row}",name="getEntityClap",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getEntityclap(Request $request)
    {
        $result = $this->clapService->getEntityClap($request);
        return $this->response($result,self::FETCH,"Clap");
    }

    /**
     * @Route("/clapsclient/{client}", name="getClientClaps",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getClientClap(Request $request)
    {
        $result = $this->clapService->getClientClap($request);
        return $this->response($result,self::FETCH,"Clap");
    }
    /**
     * @Route("/claps",name="getAllClap",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {
        $result = $this->clapService->getAll($request);
        return $this->response($result,self::FETCH,"Clap");
    }
}
