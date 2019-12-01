<?php

namespace App\Repository;

use App\Entity\ArtistEntity;
use App\Entity\EntityArtTypeEntity;
use App\Response\GetArtistByIdResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\Expr\Join;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArtistEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method ArtistEntity[]    findAll()
 * @method ArtistEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArtistEntity::class);
    }
/* Aliasis:
    a:artist
    m:media
    at:artType
    p:painting
i:interation
st:story
s:statue
    eat:entityArtType
    ei:entityInteraction
    e:entity
c:client
ap:auctionPainting
au:auctionEntity
*/
    public function findById($value)
    {
        $result=$this->createQueryBuilder('a')
            ->select('a.id','a.name','a.nationality','a.residence','a.birthDate','a.story',
                'a.Facebook','a.Twitter','a.Instagram','a.Linkedin','m.path','a.details')
            ->from('App:EntityMediaEntity','m')
            ->andWhere('a.id = :val')
            ->andWhere('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->setParameter('val', $value)
            ->orderBy('a.name')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
       $result=array_merge($result,$this->getEntityManager()->getRepository
        (EntityArtTypeEntity::class)->getArtistArtTypes($value));
        return $result;
    }

    /**
     *
     * @throws NonUniqueResultException
     */
    public function findOneById($value): ?ArtistEntity
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.id =:val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getAll()
    {

        return $this->createQueryBuilder('a')
            ->select('a.id','a.name','m.path','at.name as artType','count(p.id) as painting')
            ->from('App:EntityMediaEntity','m')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','eat')
            ->Where('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->andWhere('at.id=eat.artType')
            ->andWhere('p.artist=a.id')
            ->andWhere('eat.entity=2')
            ->andWhere('a.id=eat.row')
            ->andWhere('a.isActive=1')
            ->groupBy('a.id')
           // ->orderBy('a.id')
            ->getQuery()
            ->getResult();
    }

    public function getAllDetails()
    {
        return $this->createQueryBuilder('a')
            ->select('a.id','a.name','a.nationality','a.residence','a.birthDate','a.story',
                'a.Facebook','a.Twitter','a.Instagram','a.Linkedin','a.details','a.email','m.path','at.name as artType')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','eat')
            ->andWhere('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('at.id=eat.artType')
            ->andWhere('eat.entity=2')
            ->andWhere('a.id=eat.row')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
    }
    public function getArtistPaintings($request)
    {
        $result= $this->createQueryBuilder('a')
            ->select('p.id','p.name','p.image')
            ->from('App:PaintingEntity','p')
            ->andWhere('p.artist=:request')
            ->setParameter('request',$request)
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
       return $result;
    }
    public function search($keyword):?array
    {
        $q1= $this->createQueryBuilder('a')
            ->select('a.id','a.name','m.path')
            ->from('App:EntityMediaEntity','m')
            ->andWhere('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->andWhere('a.name LIKE :keyword')
            ->andWhere('a.isActive=1')
            ->setParameter('keyword', '%'.$keyword.'%')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
        $q2= $this->createQueryBuilder('a')
                ->select('p.id','p.name','p.image','a.name as artist')
                ->from('App:PaintingEntity','p')
                ->andWhere('p.artist=a.id')
            ->andWhere('p.active=1')
                ->andWhere('p.name LIKE :keyword')
                ->orWhere('p.keyWords LIKE :keyword')
                ->setParameter('keyword', '%'.$keyword.'%')
                ->groupBy('p.id')
                // ->setMaxResults(100)
                ->getQuery()
                ->getResult();
        return $result=array_merge($q1,$q2);
    }
    /**
     * @method getArtist
     * @param $id
     * @return ArtistEntity
     *
     */
    public function getArtist($id):ArtistEntity
    {
        try {
            return $this->createQueryBuilder('a')
                ->andWhere('a.id=:id')
                ->groupBy('a.id')
                ->getQuery()
                ->setParameter('id',$id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
}
