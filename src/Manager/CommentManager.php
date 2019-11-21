<?php


namespace App\Manager;


use App\Entity\CommentEntity;
use App\Mapper\CommentMapper;
use App\Repository\ClientEntityRepository;
use App\Repository\CommentEntityRepository;
use App\Repository\EntityRepository;
use App\Request\ByIdRequest;
use App\Request\CreateCommentRequest;
use App\Request\DeleteRequest;
use App\Request\GetClientRequest;
use App\Request\GetEntityRequest;
use App\Request\UpdateCommentRequest;
use AutoMapperPlus\AutoMapper;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CommentManager
{
    private $entityManager;
    private $commentRepository;
    private $entityRepository;
    private $clientRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,CommentEntityRepository $commentRepository,
                EntityRepository $entityRepository,ClientEntityRepository $clientRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->commentRepository=$commentRepository;
        $this->entityRepository=$entityRepository;
        $this->clientRepository=$clientRepository;
    }

    public function create(CreateCommentRequest $request)
    {
        $config = new AutoMapperConfig();
        $config->registerMapping(CreateCommentRequest::class, CommentEntity::class);
        $mapper = new AutoMapper($config);
        $request->setClient($this->clientRepository->find($request->getClient()));
        $request->setEntity($this->entityRepository->find($request->getEntity()));
        $commentData = $mapper->map($request, CommentEntity::class);
        $this->entityManager->persist($commentData);
        $this->entityManager->flush();
        return $commentData;
    }
    public function update(UpdateCommentRequest $request)
    {
        $commentEntity=$this->commentRepository->find($request->getId());
        if (!$commentEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("comment");
        }
        else {
            $config = new AutoMapperConfig();
            $config->registerMapping(UpdateCommentRequest::class, CommentEntity::class);
            $mapper = new AutoMapper($config);
            $request->setClient($this->clientRepository->find($request->getClient()));
            $request->setEntity($this->entityRepository->find($request->getEntity()));
            $commentEntity = $mapper->mapToObject($request, $commentEntity);
            $this->entityManager->flush();
            return $commentEntity;
        }
    }
    public function getEntityComment(GetEntityRequest $request)
    {
        return $commentResult =$this->commentRepository
            ->getEntityComment($request->getEntity(),($request->getRow()));
    }

    public function getClientComment(GetClientRequest $request)
    {
        return $commentResult =$this->commentRepository->getClientComment($request->getClient());
    }
    public function getAll()
    {
        return $commentResult =$this->commentRepository->getAll();
    }
    public function delete(DeleteRequest $request)
    {
        $commentEntity=$this->commentRepository->find($request->getId());
        if (!$commentEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("comment");
        }
        else {
            $this->entityManager->remove($commentEntity);
            $this->entityManager->flush();
        }
            return $commentEntity;

    }
    public function setSpacial(ByIdRequest $request)
    {
        $commentEntity=$this->commentRepository->find($request->getId());
        if (!$commentEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("comment");
        }
        else {
            $commentEntity->setSpacial(1);
            $this->entityManager->flush();
        }
        return $commentEntity;
    }
}