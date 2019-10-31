<?php


namespace App\Service;

use App\Manager\CommentManager;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

class CommentService implements CommentServiceInterface
{

    private $commentManager;


    public function __construct(CommentManager $commentManager)
    {
        $this->commentManager=$commentManager;
    }

    public function create($request)
    {
        $commentResult =$this->commentManager->create($request);
        return $commentResult;
    }
    public function update($request)
    {
        $commentResult =$this->commentManager->update($request);
        return $commentResult;
    }
    public function delete($request)
    {
        $commentResult =$this->commentManager->delete($request);
        return $commentResult;
    }


    public function getEntityComment($request)
    {
        return $commentResult =$this->commentManager->getEntityComment($request);
    }

    public function getClientComment($request)
    {
        return $commentResult =$this->commentManager->getClientComment($request);
    }

    public function getAll()
    {
        return $commentResult =$this->commentManager->getAll();
    }
}