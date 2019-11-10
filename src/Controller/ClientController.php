<?php

namespace App\Controller;

use App\Service\ClientService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ClientValidateInterface;



class ClientController extends BaseController{
private $clientService;

    public function __construct(ClientService $clientService)
{
    $this->clientService=$clientService;
}

    /**
     * @Route("/clients", name="createClient",methods={"POST"})
     * @param Request $request
     * @return
     */
    public function create(Request $request, ClientValidateInterface $clientValidate)
    {
        //Validation
        $validateResult = $clientValidate->clientValidator($request, 'create');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }

        $result = $this->clientService->create($request);
        return $this->response($result, self::CREATE);
    }

    /**
     * @Route("/client/{id}", name="updateClient",methods={"PUT"})
     * @param Request $request
     */
    public function update(Request $request,ClientValidateInterface $clientValidate)
    {
        $validateResult = $clientValidate->clientValidator($request, 'update');
        if (!empty($validateResult))
        {
            $resultResponse = new Response($validateResult, Response::HTTP_OK, ['content-type' => 'application/json']);
            $resultResponse->headers->set('Access-Control-Allow-Origin', '*');
            return $resultResponse;
        }
        $result = $this->clientService->update($request);
        return $this->response($result,self::UPDATE);
    }

    /**
     *  @Route("/client/{id}", name="deleteClient",methods={"DELETE"})
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->clientService->delete($request);
        return $this->response($result,self::DELETE);
    }


    /**
     * @Route("/clients", name="getAllClient",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->clientService->getAll($request);
        return $this->response($result,self::FETCH,"Client");
    }
    /**
     * @Route("/client/{id}", name="getClientById",methods={"GET"})
     * @param Request $request
     * @return
     */
    public function getClientById(Request $request)
    {
        $result = $this->clientService->getById($request);
        return $this->response($result,self::FETCH);
    }
}
