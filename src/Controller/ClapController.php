<?php

namespace App\Controller;

use App\Request\CreateClapRequest;
use App\Request\DeleteRequest;
use App\Request\GetClientRequest;
use App\Request\GetEntityRequest;
use App\Request\UpdateClapRequest;
use App\Service\ClapService;
use App\Validator\ClapValidateInterface;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
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
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, CreateClapRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, CreateClapRequest::class);
        $result = $this->clapService->create($request);
        return $this->response($result, self::CREATE);
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
        $id=$request->get('id');
        $data = json_decode($request->getContent(), true);
        $config = new AutoMapperConfig();
        $config->registerMapping(\stdClass::class, UpdateClapRequest::class);
        $mapper = new AutoMapper($config);
        $request = $mapper->map((object)$data, UpdateClapRequest::class);
        $request->setId($id);
        $result = $this->clapService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     *  @Route("/clap/{id}", name="deleteClap",methods={"DELETE"})
     * @param Request $request
     * @return
     */
    public function delete(Request $request)
    {
        $request=new DeleteRequest($request->get('id'));
        $result = $this->clapService->delete($request);
        return $this->response($result, self::DELETE);
    }

    /**
     * @Route("/clapsentity/{entity}/{row}",name="getEntityClap",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getEntityclap(Request $request)
    {
        $request=new GetEntityRequest($request->get('entity'),$request->get('row'));
        $result = $this->clapService->getEntityClap($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/clapsclient/{client}", name="getClientClaps",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getClientClap(Request $request)
    {
        $request=new GetClientRequest($request->get('client'));
        $result = $this->clapService->getClientClap($request);
        return $this->response($result,self::FETCH);
    }
    /**
     * @Route("/claps",name="getAllClap",methods={"GET"})
     * @return
     */
    public function getAll()
    {
        $result = $this->clapService->getAll();
        return $this->response($result,self::FETCH);
    }
}
