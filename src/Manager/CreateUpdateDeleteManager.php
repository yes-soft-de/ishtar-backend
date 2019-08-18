<?php


namespace App\Manager;


use App\Mapper\BaseMapperInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateUpdateDeleteManager implements CreateUpdateDeleteManagerInterface
{
    private $entityManager;
    private $baseMapper;

    public function __construct(EntityManagerInterface $entityManagerInterface, BaseMapperInterface $baseMapper)
    {
        $this->entityManager = $entityManagerInterface;
        $this->baseMapper = $baseMapper;
    }

    public function create(Request $request, $entity)
    {
        $data = $this->baseMapper->createMapper($request, $entity);

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }

    public function update(Request $request, $entity)
    {
        $data =$this->baseMapper->updateMapper($request, $entity);
        $this->entityManager->flush();

        return $data;
    }

    public function delete(Request $request, $entity)
    {
        $toDelete = $this->baseMapper->deleteMapper($request, $entity);

        $this->entityManager->remove($toDelete);
        $this->entityManager->flush();
    }
}