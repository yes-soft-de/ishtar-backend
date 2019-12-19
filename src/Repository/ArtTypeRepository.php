<?php

namespace App\Repository;

use App\Entity\ArtTypeEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method ArtTypeEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtTypeEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method ArtTypeEntity[]    findAll()
 * @method ArtTypeEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArtTypeEntity::class);
    }


    public function getById($value): ?array
    {
        try {
            return $this->createQueryBuilder('at')
                ->select('at.id', 'at.name','at.history', 'm.path')
                ->from('App:EntityMediaEntity', 'm')
                ->andWhere('at.id=m.row')
                ->andWhere('m.entity=3')
                ->andWhere('m.media=1')
                ->andWhere('at.id = :val')
                ->setParameter('val', $value)
                ->groupBy('at.id')
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
 public function  getArtTypeList()
   {
       return $this->createQueryBuilder('at')
           ->select('at.id','at.name','m.path')
           ->from('App:EntityMediaEntity','m')
           ->andWhere('at.id=m.row')
           ->andWhere('m.entity=3')
           ->andWhere('m.media=1')
           ->groupBy('at.id')
           ->getQuery()
           ->getResult();

   }
   public function findAll()
   {
       return $this->createQueryBuilder('at')
           ->select('at.id','at.name','at.history','m.path')
           ->from('App:EntityMediaEntity','m')
           ->andWhere('at.id=m.row')
           ->andWhere('m.entity=3')
           ->andWhere('m.media=1')
           ->groupBy('at.id')
           ->getQuery()
           ->getResult();
   }
    public function getArtType($id):ArtTypeEntity
    {
        try {
            return $this->createQueryBuilder('at')
                ->andWhere('at.id=:id')
                ->groupBy('at.id')
                ->getQuery()
                ->setParameter('id', $id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
}
