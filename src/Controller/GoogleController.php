<?php

namespace App\Controller;


use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use mysql_xdevapi\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
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
           // return new JsonResponse([$this->getTokenUser()]);
            // return $this->redirectToRoute('home_page');
            return $this->redirect('https://ishtar-art.de/');
        }

    }

    /**
     * @Route("/googletoken", name="googletoken")
     */
    public function getTokenUser(JWTTokenManagerInterface $JWTManager)
    {
        if (!$this->getUser())
        {
            return new JsonResponse(["no user is log in!"]);
        }
        elseif ($this->getUser()->getGoogle() != 1)
        {
            return new JsonResponse(["this is not google user"]);
        }
        else
        {
            return new JsonResponse(['token' => $JWTManager->create($this->getUser())]);
        }
    }


    /**
     * log out
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        //throw new Exception("ex");
        return new jsonResponse(["status_code" => "200"]);
    }
    
    /**
     * logoutRedirect
     * @Route("/logoutRedirect", name="logoutRedirect")
     */
    public function logoutRedirect()
    {
        return $this->redirect('https://ishtar-art.de/');
    }

    /**
     * @Route("/user", name="user")
     * 
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