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


}
