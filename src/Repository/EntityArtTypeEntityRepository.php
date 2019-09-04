<?php

namespace App\Repository;

use App\Entity\EntityArtTypeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EntityArtTypeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntityArtTypeEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntityArtTypeEntity[]    findAll()
 * @method EntityArtTypeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntityArtTypeEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntityArtTypeEntity::class);
    }

    // /**
    //  * @return EntityArtTypeEntity[] Returns an array of EntityArtTypeEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EntityArtTypeEntity
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
