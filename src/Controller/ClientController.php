<?php

namespace App\Controller;

use App\Service\CreateUpdateDeleteServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->response($result, self::CREATE);
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
}
