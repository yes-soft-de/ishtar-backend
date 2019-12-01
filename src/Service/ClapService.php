<?php


namespace App\Service;

use App\Manager\ClapManager;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ClapService implements ClapServiceInterface
{

    private $clapManager;


    public function __construct(ClapManager $clapManager)
    {
        $this->clapManager=$clapManager;
    }

    public function create($request)
    {
        $clapResult =$this->clapManager->create($request);
        return $clapResult;
    }
    public function update($request)
    {
        $clapResult =$this->clapManager->update($request);
        return $clapResult;
    }
    public function delete($request)
    {
        return $clapResult =$this->clapManager->delete($request);
    }


    public function getEntityClap($request)
    {
        return $clapResult =$this->clapManager->getEntityClap($request);
    }

    public function getClientClap($request)
    {
        return $clapResult =$this->clapManager->getClientClap($request);
    }
    public function getAll()
    {
        return $clapResult =$this->clapManager->getAll();
    }
}