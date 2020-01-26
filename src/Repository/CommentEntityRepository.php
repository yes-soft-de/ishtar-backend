<?php

namespace App\Repository;

use App\Entity\CommentEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CommentEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentEntity|null findOneBy(array $criteria, array $orderBy = null)
* @method CommentEntity[]    findAll()
 * @method CommentEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentEntity::class);
    }

    public function findOneById($value): ?CommentEntity
    {
        try {
            return $this->createQueryBuilder('a')
                ->andWhere('a.id =:val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
    public function getAll():?array
    {
        return $this->createQueryBuilder('q')
            ->select('ct.id','ct.body','ct.date','ct.lastEdit','ct.spacial','cl.username','e.name as entity','ct.row')
            ->from('App:CommentEntity','ct')
            ->from('App:ClientEntity','cl')
            ->from('App:Entity','e')
            ->andWhere('ct.client=cl.id')
            ->andWhere('ct.entity=e.id')
            ->groupBy('ct.id')
            ->getQuery()
            ->getResult();
    }

    public function getEntityComment($entity,$id):?array
    {
        return $this->createQueryBuilder('cl')
            ->select('cl.id','cl.body','cl.date','cl.spacial','c.username')
            ->from('App:ClientEntity','c')
            ->from('App:EntityMediaEntity','m')
            ->andWhere('cl.client=c.id')
            ->andWhere('cl.entity=:entity')
            ->andWhere('cl.row=:id')
            ->setParameter('entity',$entity)
            ->setParameter('id',$id)
            ->groupBy('cl.id')
            ->getQuery()
            ->getResult();
    }
    public function getClientComment($client):?array
    {
        return $this->createQueryBuilder('ct')
            ->select('ct.id','e.name as entity','ct.row as row','ct.body','ct.date','ct.spacial')
            ->from('App:Entity','e')
            ->andWhere('ct.client=:client')
            ->setParameter('client',$client)
            ->groupBy('ct.id')
            ->getQuery()
            ->getResult();
    }
    public function getEntity($entity,$id):?array
    {
        return $this->createQueryBuilder('cl')
            ->andWhere('cl.entity=:entity')
            ->andWhere('cl.row=:id')
            ->setParameter('entity',$entity)
            ->setParameter('id',$id)
            ->groupBy('cl.id')
            ->getQuery()
            ->getResult();
    }
}
