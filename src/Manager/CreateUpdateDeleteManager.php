<?php


namespace App\Manager;


use App\Mapper\BaseCreateMapperInterface;
use App\Mapper\BaseDeleteMapperInterface;
use App\Mapper\BaseMapperInterface;
use App\Mapper\BaseUpdateMapperInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CreateUpdateDeleteManager implements CreateUpdateDeleteManagerInterface
{
    private $entityManager;
    private $baseCreateMapper;
    private $baseUpdateMapper;
    private $baseDeleteMapper;

    public function __construct(EntityManagerInterface $entityManagerInterface, BaseCreateMapperInterface $baseCreateMapper,
BaseUpdateMapperInterface $baseUpdateMapper,BaseDeleteMapperInterface $baseDeleteMapper)
    {
        $this->entityManager = $entityManagerInterface;
        $this->baseCreateMapper = $baseCreateMapper;
        $this->baseUpdateMapper=$baseUpdateMapper;
        $this->baseDeleteMapper=$baseDeleteMapper;
    }

    public function create(Request $request, $entity)
    {
        $data = $this->baseCreateMapper->createMapper($request, $entity);
        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }

    public function update(Request $request, $entity)
    {
        $data =$this->baseUpdateMapper->updateMapper($request, $entity);
        $this->entityManager->flush();

        return $data;
    }

    public function delete(Request $request, $entity)
    {
        $toDelete = $this->baseDeleteMapper->deleteMapper($request, $entity);

        $this->entityManager->remove($toDelete);
        $this->entityManager->flush();
    }
}