<?php


namespace App\Service;

use App\Manager\ClientManager;
use App\Manager\CommentManager;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ClientService implements ClientServiceInterface
{

    private $clientManager;


    public function __construct(ClientManager $clientManager)
    {
        $this->clientManager=$clientManager;
    }

    public function register($request)
    {
      return $result =$this->clientManager->register($request);
    }

    public function login($request)
    {
        // TODO: Implement login() method.
    }
}