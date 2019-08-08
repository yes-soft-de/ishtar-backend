<?php

namespace App\Repository;

use App\Entity\AuctionPaintingEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AuctionPaintingEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuctionPaintingEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuctionPaintingEntity[]    findAll()
 * @method AuctionPaintingEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuctionPaintingEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AuctionPaintingEntity::class);
    }

    // /**
    //  * @return AuctionPaintingEntity[] Returns an array of AuctionPaintingEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AuctionPaintingEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
