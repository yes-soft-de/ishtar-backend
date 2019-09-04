<?php

namespace App\Repository;

use App\Entity\SocialMediaArtistEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SocialMediaArtistEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialMediaArtistEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialMediaArtistEntity[]    findAll()
 * @method SocialMediaArtistEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialMediaArtistEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SocialMediaArtistEntity::class);
    }

    // /**
    //  * @return SocialMediaArtistEntity[] Returns an array of SocialMediaArtistEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SocialMediaArtistEntity
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
