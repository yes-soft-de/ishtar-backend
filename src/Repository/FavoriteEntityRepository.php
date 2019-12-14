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

    public function getClientFavorite($client)
    {
        return $this->createQueryBuilder('f')
            ->select('p.id','p.name')
            ->from('App:PaintingEntity','p')
            ->andWhere('f.client=:client')
            ->andWhere('f.painting=p.id')
            ->setParameter('client',$client)
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }

}
