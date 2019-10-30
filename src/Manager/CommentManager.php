<?php


namespace App\Manager;


use App\Entity\CommentEntity;
use App\Mapper\CommentMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CommentManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function create(Request $request)
    {
        $comment = json_decode($request->getContent(),true);
        $commentEntity=new CommentEntity();
        $commentMapper = new CommentMapper();
        $commentData=$commentMapper->commentData($comment,$commentEntity,$this->entityManager);
        $this->entityManager->persist($commentData);
        $this->entityManager->flush();
        return $commentData;
    }
    public function update(Request $request)
    {
        $comment = json_decode($request->getContent(),true);
        $commentEntity=$this->entityManager->getRepository(CommentEntity::class)->find($comment['id']);
        if (!$commentEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("comment");
        }
        else {
            $commentMapper = new CommentMapper();
            $commentMapper->commentData($comment,$commentEntity,$this->entityManager);
            $this->entityManager->flush();
            return $commentEntity;
        }
    }
    public function getEntityComment($request)
    {
        $comment = json_decode($request->getContent(),true);
        return $commentResult =$this->entityManager->getRepository(CommentEntity::class)->getEntityComment($comment['entity']
        ,$comment['id']);
    }

    public function getClientComment($request)
    {
        $comment = json_decode($request->getContent(),true);
        return $commentResult =$this->entityManager->getRepository(CommentEntity::class)->getClientComment($comment['client']);
    }
    public function getAll()
    {
        return $commentResult =$this->entityManager->getRepository(CommentEntity::class)->findAll();
    }
}