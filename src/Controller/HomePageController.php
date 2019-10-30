<?php

namespace App\Controller;

use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HomePageController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     *
     *
     * @param ClientRegistry $clientRegistry
     * @return RedirectResponse
     */
    public function connectAction(ClientRegistry $clientRegistry)
    {
        return $clientRegistry
            ->getClient('google')
            ->redirect();
    }

    /**
     * @Route("/", name="home_page")
     */
    public function index(SerializerInterface $serializer, ClientRegistry $clientRegistry)
    {
         $this->connectAction($clientRegistry);

        if (!$this->getUser())
        {
            $user =  "User not found!";
        }
        else
        {
            $user = $serializer->serialize($this->getUser(),"json");
        }

        return $this->render('home_page/Home.html.twig', [
            'controller_name' => $user,
        ]);
    }
}
