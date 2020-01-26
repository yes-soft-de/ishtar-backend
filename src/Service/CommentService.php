<?php


namespace App\Service;

use App\AutoMapping;
use App\Entity\CommentEntity;
use App\Manager\CommentManager;
use App\Response\CreateCommentResponse;
use App\Response\DeleteResponse;
use App\Response\GetCommentsClientResponse;
use App\Response\GetCommentsEntityResponse;
use App\Response\GetCommentsResponse;
use App\Response\UpdateCommentResponse;

class CommentService implements CommentServiceInterface
{

    private $commentManager;
    private $autoMapping;

    public function __construct(CommentManager $commentManager,AutoMapping $autoMapping)
    {
        $this->commentManager=$commentManager;
        $this->autoMapping=$autoMapping;
    }

    public function create($request)
    {
        $commentResult =$this->commentManager->create($request);
        $response=$this->autoMapping->map(CommentEntity::class,CreateCommentResponse::class,$commentResult);
        return $response;
    }
    public function update($request)
    {
        $commentResult =$this->commentManager->update($request);
        $response=$this->autoMapping->map(CommentEntity::class,UpdateCommentResponse::class,$commentResult);
        return $response;
    }
    public function delete($request)
    {
        $commentResult =$this->commentManager->delete($request);
        $response=New DeleteResponse($commentResult->getId());
        return $response;
    }


    public function getEntityComment($request)
    {
        $response= [];
        $commentResult =$this->commentManager->getEntityComment($request);
        foreach ($commentResult as $row)
        {
            $response[]=$this->autoMapping->map('array',GetCommentsEntityResponse::class,$row);
        }

        return $response;
    }

    public function getClientComment($request)
    {
        $response= [];
        $commentResult =$this->commentManager->getClientComment($request);
        foreach ($commentResult as $row)
        {
            $response[]=$this->autoMapping->map('array',GetCommentsClientResponse::class,$row);
        }

        return $response;
    }

    public function getAll()
    {
        $response= [];
        $commentResult =$this->commentManager->getAll();
        foreach ($commentResult as $row)
        {
            $response[]=$this->autoMapping->map('array',GetCommentsResponse::class,$row);
        }

        return $response;
    }
    public function setSpacial($request)
    {
         $commentResult =$this->commentManager->setSpacial($request);
         $response=$this->autoMapping->map(CommentEntity::class,GetCommentsResponse::class,$commentResult);
        return $response;
    }
}