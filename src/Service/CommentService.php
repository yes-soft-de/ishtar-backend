<?php


namespace App\Service;

use App\Entity\CommentEntity;
use App\Manager\CommentManager;

use App\Response\DeleteResponse;
use App\Response\GetCommentsClientResponse;
use App\Response\GetCommentsEntityResponse;
use App\Response\GetCommentsResponse;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
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
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', DeleteResponse::class);
        $mapper = new AutoMapper($config);
        $response=$mapper->map($commentResult,DeleteResponse::class);
        return $response;
    }


    public function getEntityComment($request)
    {
        $commentResult =$this->commentManager->getEntityComment($request);
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetCommentsEntityResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($commentResult as $row)
            $response[]=$mapper->map($row,GetCommentsEntityResponse::class);
        return $response;
    }

    public function getClientComment($request)
    {
        $commentResult =$this->commentManager->getClientComment($request);
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetCommentsClientResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($commentResult as $row)
            $response[]=$mapper->map($row,GetCommentsClientResponse::class);
        return $response;
    }

    public function getAll()
    {
        $commentResult =$this->commentManager->getAll();
        $config = new AutoMapperConfig();
        $config->registerMapping( 'array', GetCommentsResponse::class);
        $mapper = new AutoMapper($config);
        foreach ($commentResult as $row)
            $response[]=$mapper->map($row,GetCommentsResponse::class);
        return $response;
    }
    public function setSpacial($request)
    {
         $commentResult =$this->commentManager->setSpacial($request);
        $config = new AutoMapperConfig();
        $config->registerMapping( CommentEntity::class, GetCommentsResponse::class);
        $mapper = new AutoMapper($config);
            $response=$mapper->map($commentResult,GetCommentsResponse::class);
        return $response;
    }
}