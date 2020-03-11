<?php

namespace App\Repository;

use App\Entity\ArtistTranslationEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ArtistTranslationEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistTranslationEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArtistTranslationEntity[]    findAll()
 * @method ArtistTranslationEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistTranslationEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtistTranslationEntity::class);
    }

    // /**
    //  * @return ArtistTranslationEntity[] Returns an array of ArtistTranslationEntity objects
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
    public function findOneBySomeField($value): ?ArtistTranslationEntity
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
