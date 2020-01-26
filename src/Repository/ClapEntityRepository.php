<?php

namespace App\Repository;

use App\Entity\ClapEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClapEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClapEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClapEntity[]    findAll()
 * @method ClapEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClapEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClapEntity::class);
    }

    public function findOneById($value): ?ClapEntity
    {
        try {
            return $this->createQueryBuilder('cp')
                ->andWhere('cp.id =:val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
    public function getEntityClap($entity,$id):?array
    {
        return $this->createQueryBuilder('cp')
            ->select('cp.id','cp.value','c.username','cp.date')
            ->from('App:ClientEntity','c')
            ->andWhere('cp.client=c.id')
            ->andWhere('cp.entity=:entity')
            ->andWhere('cp.row=:id')
            ->setParameter('entity',$entity)
            ->setParameter('id',$id)
            ->groupBy('cp.id')
            ->getQuery()
            ->getResult();
    }
    public function getClientClap($client):?array
    {
        return $this->createQueryBuilder('cp')
            ->select('e.name as entity','cp.row as id','cp.value','cp.id as ClapId','cp.date')
            ->from('App:Entity','e')
            ->andWhere('cp.entity=e.id')
            ->andWhere('cp.client=:client')
            ->setParameter('client',$client)
            ->groupBy('cp.id')
            ->getQuery()
            ->getResult();
    }
    public function getEntity($entity,$id):?array
    {
        return $this->createQueryBuilder('cp')
            ->andWhere('cp.entity=:entity')
            ->andWhere('cp.row=:id')
            ->setParameter('entity',$entity)
            ->setParameter('id',$id)
            ->groupBy('cp.id')
            ->getQuery()
            ->getResult();
    }
}
