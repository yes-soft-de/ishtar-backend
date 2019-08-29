<?php

namespace App\Repository;

use App\Entity\PaintingEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaintingEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaintingEntity[]    findAll()
 * @method PaintingEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PaintingEntity::class);
    }



    public function findByArtist($value):?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.artist = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByArtType($value):?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.artType = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }



    public function findOneById($value): ?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
