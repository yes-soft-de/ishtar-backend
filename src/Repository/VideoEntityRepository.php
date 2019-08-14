<?php

namespace App\Repository;

use App\Entity\VideoEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method VideoEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoEntity[]    findAll()
 * @method VideoEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, VideoEntity::class);
    }

    // /**
    //  * @return VideoEntity[] Returns an array of VideoEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findOneById($value): ?VideoEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
