<?php

namespace App\Controller;

use App\AutoMapping;
use App\Request\CreateClapRequest;
use App\Request\DeleteRequest;
use App\Request\GetClientRequest;
use App\Request\GetEntityRequest;
use App\Request\UpdateClapRequest;
use App\Service\ClapService;
use App\Validator\ClapValidateInterface;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClapController extends BaseController
{
    private $clapService;
    private $autoMapping;

    /**
     * ClapController constructor.
     * @param $clapService
     */
    public function __construct(ClapService $clapService,AutoMapping $autoMapping)
    {
        $this->clapService = $clapService;
        $this->autoMapping=$autoMapping;
    }

    /**
     * @Route("/claps", name="createClap",methods={"POST"})
     * @param Request $request
     * @param ClapValidateInterface $clapValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
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
        $data = json_decode($request->getContent(), true);
        $request=$this->autoMapping->map(\stdClass::class,CreateClapRequest::class,(object)$data);
        $result = $this->clapService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/clap/{id}", name="updateClap",methods={"PUT"})
     * @param Request $request
     * @param ClapValidateInterface $clapValidate
     * @return JsonResponse|Response
     * @throws UnregisteredMappingException
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
        $request=$this->autoMapping->map(\stdClass::class,UpdateClapRequest::class,(object)$data);
        $request->setId($id);
        $result = $this->clapService->update($request);
        return $this->response($result, self::UPDATE);
    }

    /**
     * @Route("/clap/{id}", name="deleteClap",methods={"DELETE"})
     * @param Request $request
     * @return JsonResponse
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
     * @return JsonResponse
     */
    public function getEntityClap(Request $request)
    {
        $request=new GetEntityRequest($request->get('entity'),$request->get('row'));
        $result = $this->clapService->getEntityClap($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/clapsclient/{client}", name="getClientClaps",methods={"GET"})
     * @param Request $request
     * @return JsonResponse
     */
    public function getClientClap(Request $request)
    {
        $request=new GetClientRequest($request->get('client'));
        $result = $this->clapService->getClientClap($request);
        return $this->response($result,self::FETCH);
    }

    /**
     * @Route("/claps",name="getAllClap",methods={"GET"})
     * @return JsonResponse
     */
    public function getAll()
    {
        $result = $this->clapService->getAll();
        return $this->response($result,self::FETCH);
    }
}
