<?php


namespace App\Manager;


use App\Entity\ArtistEntity;
use App\Mapper\BaseMapperInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ArtistManager implements ArtistManagerInterface
{
    private $entityManager;
    private $serializer;
    private $baseMapper;

    public function __construct(EntityManagerInterface $entityManagerInterface, SerializerInterface $serializer, BaseMapperInterface $baseMapper)
    {
        $this->entityManager = $entityManagerInterface;
        $this->serializer = $serializer;
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
        $this->baseMapper->updateMapper($request, $entity);
        $this->entityManager->flush();
    }

    public function delete(Request $request, $entity)
    {
        $toDelete = $this->baseMapper->deleteMapper($request, $entity);

        $this->entityManager->remove($toDelete);
        $this->entityManager->flush();
    }
}