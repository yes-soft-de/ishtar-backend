<?php

namespace App\Repository;

use App\Entity\MediaEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MediaEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MediaEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MediaEntity[]    findAll()
 * @method MediaEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediaEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MediaEntity::class);
    }
    // /**
    //  * @return MediaEntity[] Returns an array of MediaEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */



}
