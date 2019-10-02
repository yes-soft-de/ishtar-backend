<?php

namespace App\Controller;


use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GoogleController extends AbstractController
{
    /**
     * Link to this controller to start the "connect" process
     *
     * @Route("/connect/google", name="connect_google")
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
     * Google redirects to back here afterwards
     *
     * @Route("/connect/google/check", name="connect_google_check")
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function connectCheckAction(Request $request)
    {
        if (!$this->getUser()) {
            return new JsonResponse(array('status' => false, 'message' => "User not found!"));
        } else
        {
            // return $this->redirectToRoute('home_page');
            return $this->redirect('http://ishtar.esy.es/');
        }
    }

    /**
     * log out
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new Exception("ex");
    }

    /**
     * @Route("/user", name="user")
     */
    public function getUserAccount(SerializerInterface $serializer)
    {
        $user = $this->getUser();

        if (!$this->getUser())
        {
            $response = new jsonResponse(["status_code" => "200",
                    "Data" => "0"
                ]
                , Response::HTTP_OK);
            $response->headers->set('Access-Control-Allow-Headers', 'X-Header-One,X-Header-Two');
            $response->headers->set('Access-Control-Allow-Origin', '*');
            return $response;
        }

        $result = $serializer->serialize($user, "json");
        $response = new jsonResponse(["status_code" => "200",
                "Data" => json_decode($result)
            ]
            , Response::HTTP_OK);
        $response->headers->set('Access-Control-Allow-Headers', 'X-Header-One,X-Header-Two');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
    }
}