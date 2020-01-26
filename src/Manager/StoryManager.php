<?php


namespace App\Manager;

use App\Entity\StoryEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\Entity;
use App\Entity\EntityArtTypeEntity;
use App\Mapper\AutoMapper;
use App\Mapper\StoryMapper;
use App\Repository\EntityRepository;
use App\Repository\StoryEntityRepository;
use App\Request\DeleteRequest;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class StoryManager
{
    private $entityManager;
    private $storyRepository;
    private $entityRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,StoryEntityRepository $storyRepository
        ,EntityRepository $entityRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->storyRepository=$storyRepository;
        $this->entityRepository=$entityRepository;

    }

    public function create($request,$entity,$id)
    {
        $storyEntity=new StoryEntity();
        $storyEntity->setEntity($this->entityRepository->find($entity))
            ->setRow($id)
            ->setStory($request->getStory());
        $this->entityManager->persist($storyEntity);
        $this->entityManager->flush();
        return $storyEntity;
    }

        public function update($request,$entity)
    {

        $storyEntity=$this->storyRepository->findEntity($request->getId(),$entity);
        if (!$storyEntity) {
            $exception=new EntityException();
            $exception->entityNotFound("story");
        }
        else {

            $storyEntity->setStory($request->getStory());
            $this->entityManager->flush();
            return $storyEntity;
        }
    }

    public function delete(DeleteRequest $request,$entity)
    {

        $story=$this->storyRepository->findEntity($request->getId(),$entity);
        if (!$story) {
            $exception=new EntityException();
            $exception->entityNotFound("artType");
        }
        else {
        $this->entityManager->remove($story);
        $this->entityManager->flush();
    }}

}
