<?php

namespace App\Repository;

use App\Entity\PantingImageEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PantingImageEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PantingImageEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PantingImageEntity[]    findAll()
 * @method PantingImageEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PantingImageEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PantingImageEntity::class);
    }

    // /**
    //  * @return PantingImageEntity[] Returns an array of PantingImageEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findOneById($value): ?PantingImageEntity
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
