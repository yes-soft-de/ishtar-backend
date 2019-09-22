<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Validator\ClientValidateInterface;



class ClientController extends BaseController
{


    /**
     * @Route("/createClient", name="createClient")
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

        $result = $this->CUDService->create($request, "Client");
        $this->CUDService->create($request,"MediaClient");
        return $this->response($result, self::CREATE, "Client");
    }

    /**
     * @Route("/updateClient", name="updateClient")
     * @param Request $request
     */
    public function update(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->update($request, "Client");
        return $result;
    }

    /**
     * @Route("/deleteClient", name="deleteClient")
     * @param Request $request
     */
    public function delete(Request $request)
    {
        //ToDo Call Validator

        $result = $this->CUDService->delete($request, "Client");
        return $result;
    }


    /**
     * @Route("/getAllClient",name="getAllClient")
     * @param Request $request
     * @return
     */
    public function getAll(Request $request)
    {

        $result = $this->FDService->fetchData($request,"Client");
        return $this->response($result,self::FETCH,"Client");
    }
    /**
     * @Route("/getClientById", name="getClientById")
     * @param Request $request
     * @return
     */
    public function getClientById(Request $request)
    {
        $result = $this->FDService->getClientById($request);
        return $this->response($result,self::FETCH,"Client");
    }
}
