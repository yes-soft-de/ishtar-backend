<?php

namespace App\Repository;

use App\Entity\ClapEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClapEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClapEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClapEntity[]    findAll()
 * @method ClapEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClapEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ClapEntity::class);
    }

    // /**
    //  * @return ClapEntity[] Returns an array of ClapEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findOneById($value): ?ClapEntity
    {
        return $this->createQueryBuilder('cp')
            ->andWhere('cp.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getEntityClap($entity,$id):?array
    {
        return $this->createQueryBuilder('cp')
            ->select('cp.id','cp.value','c.userName','m.path as image')
            ->from('App:ClientEntity','c')
            ->from('App:EntityMediaEntity','m')
            ->andWhere('cp.client=c.id')
            ->andWhere('cp.entity=:entity')
            ->andWhere('cp.row=:id')
            ->andWhere('m.entity=5')
            ->andWhere('m.media=1')
            ->andWhere('cp.id=m.row')
            ->setParameter('entity',$entity)
            ->setParameter('id',$id)
            ->groupBy('cp.id')
            ->getQuery()
            ->getResult();
    }
    public function getClientClap($client):?array
    {
        return $this->createQueryBuilder('cp')
            ->select('e.name as entity','c.row as id','cp.value','cp.id as ClapID')
            ->from('App:Entity','e')
            ->andWhere('cp.entity=e.id')
            ->andWhere('cp.client=:client')
            ->setParameter('client',$client)
            ->groupBy('cp.id')
            ->getQuery()
            ->getResult();
    }
}
