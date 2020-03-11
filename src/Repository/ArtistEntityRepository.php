<?php

namespace App\Repository;

use App\Entity\ArtistEntity;
use App\Entity\EntityArtTypeEntity;
use App\EventListener\LocaleListener;
use App\Response\GetArtistByIdResponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query\Expr\Join;

/**
 * @method ArtistEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArtistEntity|null findOneBy(array $criteria, array $orderBy = null)
 //* @method ArtistEntity[]    findAll()
 * @method ArtistEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtistEntityRepository extends ServiceEntityRepository
{
    private $locale;

    public function __construct(ManagerRegistry $registry, LocaleListener $localeListener)
    {
        parent::__construct($registry, ArtistEntity::class);

        if (null == $localeListener->getLocale())
        {
            $this->locale = "en";
        }
        else
        {
            $this->locale = $localeListener->getLocale();
        }

    }

    private function findArtistByID($value)
    {
        $result = $this->createQueryBuilder('a')
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

    public function findById($value)
    {
        if ($this->locale == "en")
        {
            $result = $this->findArtistByID($value);
            return $result;
        }
        else
        {
            $result = $this->findArtistByID($value);

            $languageResult = $this->createQueryBuilder('a')
                ->select('a.id','artistTranslation.name','artistTranslation.nationality','artistTranslation.residence','a.birthDate',
                    'artistTranslation.story', 'a.Facebook','a.Twitter','a.Instagram','a.Linkedin','m.path','artistTranslation.details',
                    'artistTranslation.artType' )
                ->from('App:EntityMediaEntity','m')
                //
                ->from('App:ArtistTranslationEntity', 'artistTranslation')
                ->andWhere('artistTranslation.originID = a.id')
                ->andWhere('artistTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('a.id = :val')
                ->andWhere('a.id=m.row')
                ->andWhere('m.entity=2')
                ->andWhere('m.media=1')
                ->setParameter('val', $value)
                ->orderBy('a.name')
                ->groupBy('a.id')
                ->getQuery()
                ->getResult();

            if (empty($languageResult))
            {
                return $result;
            }
            else
            {
                return $languageResult;
            }
        }
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

    private  function getAllArtist()
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

    public function getAll()
    {
        if ($this->locale == "en")
        {
            $result = $this->getAllArtist();
            return $result;
        }
        else
        {
            $result = $this->getAllArtist();

            $languageResult = $this->createQueryBuilder('a')
                ->select('a.id','artistTranslation.name','m.path','artistTranslation.artType as artType','count(p.id) as painting')
                ->from('App:EntityMediaEntity','m')
                ->from('App:PaintingEntity','p')
                ->from('App:ArtTypeEntity','at')
                ->from('App:EntityArtTypeEntity','eat')
                //
                ->from('App:ArtistTranslationEntity', 'artistTranslation')
                ->andWhere('artistTranslation.originID = a.id')
                ->andWhere('artistTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('a.id=m.row')
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

            return $this->finalTranslationResult($languageResult, $result);
        }
    }

    public function getAllDetails()
    {
        return $this->createQueryBuilder('a')
            ->select('a.id','a.name','a.nationality','a.residence','a.birthDate','a.story',
                'a.Facebook','a.Twitter','a.Instagram','a.Linkedin','a.details','a.email','m.path as image' ,'at.name as artType')
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
            ->select('a.name as artist','p.id','p.name','p.image')
            ->from('App:PaintingEntity','p')
            ->andWhere('p.artist=:request')

            ->setParameter('request',$request)
            ->andWhere('a.id=:request1')
            ->setParameter('request1',$request)
            ->groupBy('p.id')
            ->getQuery()
            ->getResult();
       return $result;
    }

    private function searchArtist($keyword)
    {
        return $this->createQueryBuilder('a')
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
    }

    private function searchPainting($keyword)
    {
        return $this->createQueryBuilder('a')
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
    }

    public function search($keyword):?array
    {
        if ($this->locale == "en")
        {
            $q1 = $this->searchArtist($keyword);
            $q2  = $this->searchPainting($keyword);

            return $result = array_merge($q1, $q2);
        }
        else
        {
            $q1 = $this->searchArtist($keyword);
            $q2  = $this->searchPainting($keyword);

            $languageResultArtists = $this->createQueryBuilder('a')
                ->select('a.id','artistTranslation.name','m.path')
                ->from('App:EntityMediaEntity','m')
                //
                ->from('App:ArtistTranslationEntity', 'artistTranslation')
                ->andWhere('a.name LIKE :keyword')
                ->andWhere('artistTranslation.name LIKE :keyword')
                ->andWhere('a.isActive=1')
                ->setParameter('keyword', '%'.$keyword.'%')
                ->andWhere('artistTranslation.originID = a.id')
                ->andWhere('artistTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('a.id=m.row')
                ->andWhere('m.entity=2')
                ->andWhere('m.media=1')

                ->groupBy('a.id')
                ->getQuery()
                ->getResult();

            $languageResultPaintings = $this->createQueryBuilder('a')
                ->select('p.id','paintingTranslation.name','p.image','paintingTranslation.artist as artist')
                ->from('App:PaintingEntity','p')
                //
                ->from('App:PaintingTranslationEntity', 'paintingTranslation')
                ->andWhere('p.name LIKE :keyword')
                ->orWhere('p.keyWords LIKE :keyword')
                ->orWhere('paintingTranslation.name LIKE :keyword')
                ->orWhere('paintingTranslation.keyWords LIKE :keyword')
                ->setParameter('keyword', '%'.$keyword.'%')
                ->andWhere('paintingTranslation.originID = p.id')
                ->andWhere('paintingTranslation.language =:locale')
                ->setParameter('locale', $this->locale)
                //
                ->andWhere('p.artist=a.id')
                ->andWhere('p.active=1')

                ->groupBy('p.id')
                // ->setMaxResults(100)
                ->getQuery()
                ->getResult();
           // dd($languageResultPaintings);
            $finalQ2 = $this->finalTranslationResult($languageResultPaintings, $q2);
            $finalQ1 = $this->finalTranslationResult($languageResultArtists, $q1);

            return array_merge($finalQ2, $finalQ1);
        }
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

    private function finalTranslationResult($languageResult, $result):?array
    {
        foreach ($languageResult as $singleLanguageResult)
        {
            foreach ($result as $index => $singleResult)
            {
                if ($singleResult['id'] == $singleLanguageResult['id'])
                {
                    unset($result[$index]);
                }
            }
        }

        foreach ($languageResult as $singleLanguageResult)
        {
            $result[] = $singleLanguageResult;
        }

        return $result;
    }
}
