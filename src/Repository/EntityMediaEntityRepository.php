<?php

namespace App\Repository;

use App\Entity\EntityMediaEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method EntityMediaEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method EntityMediaEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method EntityMediaEntity[]    findAll()
 * @method EntityMediaEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class
EntityMediaEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EntityMediaEntity::class);
    }

    // /**
    //  * @return EntityMediaEntity[] Returns an array of EntityMediaEntity objects
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
    public function findOneBySomeField($value): ?EntityMediaEntity
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getPaintingImages($painting): ?array
    {
        return $this->createQueryBuilder('m')
            ->select('m.path as image')
            ->andWhere('m.row = :val')
            ->andWhere('m.entity=1')
            ->andWhere('m.media=1')
            ->setParameter('val', $painting)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findPaintingImage($painting): ?array
    {
        return $this->createQueryBuilder('m')
            ->select('m.path as image')
            ->andWhere('m.row = :val')
            ->andWhere('m.entity=1')
            ->andWhere('m.media=1')
            ->setParameter('val', $painting)
            ->getQuery()
            ->getResult()
            ;
    }
    public function findImages($id,$entity)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.row = :val')
            ->andWhere('m.entity=:entity')
            ->andWhere('m.media=1')
            ->setParameter('val', $id)
            ->setParameter('entity', $entity)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
