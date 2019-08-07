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
class PaintingRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PaintingEntity::class);
    }

    // /**
    //  * @return PaintingEntity[] Returns an array of PaintingEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PaintingEntity
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
