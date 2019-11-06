<?php
namespace App\Controller;
use App\Entity\ClientEntity;
use App\Service\ClientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController extends AbstractController
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
            return new Response($errorsString);
        }
        //

       $client= $this->clientService->register($request);
        return new Response(sprintf('User %s successfully created', $client->getEmail()));
    }

    public function api()
    {
        return new Response(sprintf('Logged in as %s', $this->getUser()->GetEmail()));
    }
}
