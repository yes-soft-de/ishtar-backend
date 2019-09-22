<?php

namespace App\Repository;

use App\Entity\StoryEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StoryEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method StoryEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method StoryEntity[]    findAll()
 * @method StoryEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StoryEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StoryEntity::class);
    }



    public function findByPainting($value):?storyEntity
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.row = :val')
            ->andWhere('s.entity=1')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?StoryEntity
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
