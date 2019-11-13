<?php


namespace App\Controller;

use App\Service\ClientService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class RegistrationController extends BaseController
{

private $clientService;
    /**
     * RegistrationController constructor.
     */
    public function __construct(ClientService $clientService)
    {
        $this->clientService=$clientService;
    }

    public function register(Request $request, ValidatorInterface $validator)
    {
        //validation
        $errors = $validator->validate($request);

        if (count($errors) > 0)
        {
            $errorsString = (string) $errors;
            return $this->respondUnauthorized($errorsString) ;
        }
        //

       $client= $this->clientService->register($request);
        return $this->response(sprintf('User %s successfully created', $client->getEmail()),self::CREATE);
    }

    public function api()
    {
        return $this->response(sprintf('Logged in as %s', $this->getUser()->GetEmail()),self::STATE_OK);
    }
}
