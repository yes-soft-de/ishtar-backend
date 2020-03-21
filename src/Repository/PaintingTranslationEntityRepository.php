<?php

namespace App\Repository;

use App\Entity\PaintingTranslationEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PaintingTranslationEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingTranslationEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaintingTranslationEntity[]    findAll()
 * @method PaintingTranslationEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingTranslationEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaintingTranslationEntity::class);
    }

    public function getPaintingArtTypes($id, $lang):?array
    {
        return $this->createQueryBuilder('eat')
            ->select('at.artType as artType')
            ->from('App:PaintingTranslationEntity','at')
            ->andWhere('at.language =:locale')
            ->setParameter('locale', $lang)

            ->andWhere('at.originID=:id')
            ->setParameter('id',$id)
            ->groupBy('at.id')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return PaintingTranslationEntity[] Returns an array of PaintingTranslationEntity objects
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
    public function findOneBySomeField($value): ?PaintingTranslationEntity
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
