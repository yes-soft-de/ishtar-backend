<?php

namespace App\Repository;

use App\Entity\EntityArtTypeEntity;
use App\Entity\EntityMediaEntity;
use App\Entity\PaintingEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaintingEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaintingEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method PaintingEntity[]    findAll()
 * @method PaintingEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintingEntityRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PaintingEntity::class);
    }

    public function findOneById($value): ?array
    {
        $result = $this->createQueryBuilder('q')
            ->select('p.id','p.name','p.keyWords','p.state','p.height','p.width','p.colorsType','p.image'
                ,'p.active','a.id as artistId','a.name as artist','st.story','pr.price')
            ->from('App:PaintingEntity','p')
            ->from('App:ArtistEntity','a')
            ->from('App:StoryEntity','st')
            ->from('App:PriceEntity', 'pr')
            ->andWhere('p.id=pr.row')
            ->andWhere('pr.entity=1')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=st.row')
            ->andWhere('p.id = :val')
            ->andWhere('st.entity=1')
            ->groupBy('p.id')
            ->setParameter('val', $value)
            ->getQuery()
            ->getArrayResult();
    $result=array_merge($result,$this->getEntityManager()->getRepository
    (EntityArtTypeEntity::class)->getPaintingArtTypes($value));
    $result=array_merge($result,$this->getEntityManager()->getRepository(EntityMediaEntity::class)->findPaintingImage($value));
        return $result;
    }

    public function getAll():?array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id','p.name','p.state','p.height','p.width','p.colorsType','p.image','p.active',
               'p.keyWords', 'a.name as artist','at.name as artType','st.story','pr.price')
            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','eat')
            ->from('App:StoryEntity','st')
            ->from('App:PriceEntity','pr')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=eat.row')
            ->andWhere('at.id=eat.artType')
            ->andWhere('eat.entity=1')
            ->andWhere('p.id=st.row')
            ->andWhere('st.entity=1')
            ->andWhere('p.id=pr.row')
            ->andWhere('pr.entity=1')
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
    }

    public function getBy($parm,$value):?array
    {
        if($parm=='artType')
            $parm='ea.artType='.$value;
        else
        $parm = "p." . $parm . "='" . $value . "'";

        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.name', 'p.keyWords', 'p.state', 'p.height', 'p.width', 'p.colorsType', 'p.image',
                'p.active', 'a.name as artist', 'at.name as artType','pr.price')
            ->from('App:ArtistEntity', 'a')
            ->from('App:ArtTypeEntity', 'at')
            ->from('App:EntityArtTypeEntity', 'eat')
            ->from('App:PriceEntity', 'pr')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=eat.row')
            ->andWhere('at.id=eat.artType')
            ->andWhere('eat.entity=1')
            ->andWhere($parm)
            ->andWhere('p.id=pr.row')
            ->andWhere('pr.entity=1')
            ->andWhere('p.active=1')
            ->orderBy('p.id', 'ASC')
            ->groupBy('p.name')
            ->getQuery()
            ->getResult();
    }

    public function getPaintingShort():?array
    {
        return $this->createQueryBuilder('p')
            ->select('p.id','p.name','p.image','p.height','p.width','a.id as artistId','a.name as artist','at.name as artType')
            ->from('App:ArtistEntity','a')
            ->from('App:EntityArtTypeEntity','eat')
            ->from('App:ArtTypeEntity','at')
            ->andWhere('p.artist=a.id')
            ->andWhere('p.id=eat.row')
            ->andWhere('eat.entity=1')
            ->andWhere('eat.artType=at.id')
            ->andWhere('p.active=1')
            ->groupBy('p.id')
           // ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }

    public function findAll()
    {
        return $this->createQueryBuilder('p')
            ->select('a.id','a.name','count(p) as painting','at.name as artType','m.path as image')
            ->from('App:EntityMediaEntity','m')
            ->from('App:ArtistEntity','a')
            ->from('App:ArtTypeEntity','at')
            ->from('App:EntityArtTypeEntity','eat')
           ->distinct('p.id')
            ->Where('a.id=m.row')
            ->andWhere('m.entity=2')
            ->andWhere('m.media=1')
            ->andWhere('at.id=eat.artType')
            ->andWhere('p.artist=a.id')
            ->andWhere('eat.entity=2')
            ->andWhere('p.active=1')
            ->andWhere('a.id=ea.row')
            ->groupBy('a.id')
            ->getQuery()
            ->getResult();
    }

    /**
     * @method getPainting
     * @param $id
     * @return PaintingEntity
     *
     */
    public function getPainting($id):PaintingEntity
    {
        try {
            return $this->createQueryBuilder('p')
                ->andWhere('p.id=:id')
                ->groupBy('p.id')
                ->getQuery()
                ->setParameter('id',$id)
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }
}
