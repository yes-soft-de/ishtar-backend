<?php

namespace App\Repository;

use App\Entity\GalleryEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method GalleryEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method GalleryEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method GalleryEntity[]    findAll()
 * @method GalleryEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GalleryEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GalleryEntity::class);
    }

    // /**
    //  * @return GalleryEntity[] Returns an array of GalleryEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GalleryEntity
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
