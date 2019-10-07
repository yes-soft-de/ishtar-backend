<?php

namespace App\Repository;

use App\Entity\FavoriteEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FavoriteEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method FavoriteEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method FavoriteEntity[]    findAll()
 * @method FavoriteEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FavoriteEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FavoriteEntity::class);
    }

    // /**
    //  * @return FavoriteEntity[] Returns an array of FavoriteEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FavoriteEntity
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getClientFavorite($client)
    {
        return $this->createQueryBuilder('q')
            ->select('p.id','p.name')
            ->from('App:PaintingEntity','p')
            ->from('App:FavoriteEntity','f')
            ->andWhere('f.client='.$client)
            ->andWhere('f.painting=p.id')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }

}
