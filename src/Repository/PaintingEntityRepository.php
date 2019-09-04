<?php

namespace App\Repository;

use App\Entity\PaintingEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaintingEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaintingEntity[]    findAll()
 * @method PaintingEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PaintingEntity::class);
    }


    public function findByArtist($value): ?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.artist = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findByArtType($value): ?array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.artType = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findOneById($value): ?array
    {
        $result = $this->createQueryBuilder('p')
        ->andWhere('p.id = :val')
        ->setParameter('val', $value)
        ->getQuery()
        ->getArrayResult();
$result=array_merge($result,$this->getEntityManager()->getRepository
(ImageEntity::class)->findByPainting($value));
        return $result;
    }

    public function getAll():?array
    {
        return $this->createQueryBuilder('q')
            ->select('p.id','p.name','p.story','p.state','p.height','p.width','p.colorsType','p.image','a.name as artist','at.name as artType')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','ea')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=ea.row')
            ->andWhere('at.id=ea.artType')
            ->andWhere('ea.entity=1')
            ->setMaxResults(10)
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }
    public function getBy($parm,$value):?array
    {
        $parm="p.".$parm."='".$value."'";

        return $this->createQueryBuilder('q')
            ->select('p.id','p.name','p.price','p.story','p.state','p.deminsions','a.name as artist','at.name as artType','i.url')
            ->from('App:PaintingEntity','p')
            ->from('App:ImageEntity','i')
            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->andWhere($parm)
            ->andWhere('p.artist=a.id')
            ->andWhere('p.artType=at.id')
            ->andWhere('p.id=i.painting' )
            ->orderBy('p.id', 'ASC')
            ->groupBy('p.name')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }
    public function getPaintingShort():?array
    {
        return $this->createQueryBuilder('q')
            ->select('p.id','p.name','p.image','p.height','p.width','a.name as artist','at.name as artType')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtistEntity','a')
            ->from('App:EntityArtTypeEntity','ea')
            ->from('App:ArtTypeEntity','at')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=ea.row')
            ->andWhere('ea.entity=1')
            ->andWhere('ea.artType=at.id')
            ->groupBy('p.id')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }

}
