<?php

namespace App\Repository;

use App\Entity\ImageEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ImageEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageEntity[]    findAll()
 * @method ImageEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImageEntity::class);
    }

    public function findByPainting($value):?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.painting = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }


    public function findOneById($value):?ImageEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
