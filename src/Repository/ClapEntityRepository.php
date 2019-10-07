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
        return $this->createQueryBuilder('a')
            ->andWhere('a.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getEntityClap($entity,$id):?array
    {
        return $this->createQueryBuilder('q')
            ->select('c.id','c.value','cl.userName','m.path as image')
            ->from('App:ClapEntity','c')
            ->from('App:ClientEntity','cl')
            ->from('App:EntityMediaEntity','m')
            ->andWhere('c.client=cl.id')
            ->andWhere('c.entity='.$entity)
            ->andWhere('c.row='.$id)
            ->andWhere('m.entity=5')
            ->andWhere('m.media=1')
            ->andWhere('c.id=m.row')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }
    public function getClientClap($client):?array
    {
        return $this->createQueryBuilder('q')
            ->select('e.name as entity','c.row as id','c.value','c.id as ClapID')
            ->from('App:ClapEntity','c')
            ->from('App:Entity','e')
            ->andWhere('c.entity=e.id')
            ->andWhere('c.client='.$client)
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }
}
