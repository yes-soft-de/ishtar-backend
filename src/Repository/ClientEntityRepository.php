<?php

namespace App\Repository;

use App\Entity\ClientEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ClientEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClientEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method ClientEntity[]    findAll()
 * @method ClientEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientEntity::class);
    }

    // /**
    //  * @return ClientEntity[] Returns an array of ClientEntity objects
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

    public function findClient($value)
    {
        try {
            return $this->createQueryBuilder('c')
                ->select('c.id','c.username','c.fullName','c.phone','c.email','c.birthDate','m.path as image', 'c.language')
                ->from('App:EntityMediaEntity','m')
                ->andWhere('m.entity=5')
                ->andWhere('m.row= :val')
                ->andWhere('m.media=1')
                ->andWhere('c.id = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
    public function findAll()
    {
        return $this->createQueryBuilder('c')
            ->select('c.id','c.username','c.fullName','c.phone','c.email','c.birthDate','m.path as image')
            ->from('App:EntityMediaEntity','m')
            ->andWhere('m.entity=5')
            ->andWhere('m.row=c.id')
            ->andWhere('c.isActive=1')
            ->groupBy('c.id')
            ->getQuery()
            ->getResult();
    }


}
