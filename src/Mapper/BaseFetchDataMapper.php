<?php


namespace App\Mapper;


use App\Entity\ArtistEntity;
use App\Entity\ArtTypeEntity;
use App\Entity\ClientEntity;
use App\Entity\PaintingEntity;
use App\Entity\InteractionEntity;
use App\Entity\AuctionEntity;
use App\Entity\AuctionPaintingEntity;
use App\Entity\ArtistArtTypeEntity;
use App\Entity\PaintingTransactionEntity;
use App\Entity\ImageEntity;
use App\Entity\VideoEntity;
use App\Entity\ClapEntity;
use App\Entity\CommentEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ArtistEntityRepository;


class BaseFetchDataMapper implements BaseFetchDataMapperInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function fetchDataMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity) {
            case "Artist":
                $data = $this->entityManager->getRepository(ArtistEntity::class)->findAll();
                break;

            case "ArtType":
                $data = $this->entityManager->getRepository(ArtTypeEntity::class)->findAll();
                break;

            case "Painting":
                $data = $this->entityManager->getRepository(PaintingEntity::class)->findAll();
                break;

            case "Client":
                $data = $this->entityManager->getRepository(ClientEntity::class)->findAll();
                break;

            case "Interaction":
                $data = $this->entityManager->getRepository(InteractionEntity::class)->findAll();
                break;

            case "Auction":
                return $this->entityManager->getRepository(AuctionEntity::class)->findAll();
                break;

            case "AuctionPainting":
                $data = $this->entityManager->getRepository(AuctionPaintingEntity::class)->findAll();
                break;

            case "ArtistArtType":
                $data = $this->entityManager->getRepository(ArtistArtTypeEntity::class)->findAll();
                break;

            case "PaintingTransaction":
                $data = $this->entityManager->getRepository(PaintingTransactionEntity::class)->findAll();
                break;

            case "Image":
                $data = $this->entityManager->getRepository(ImageEntity::class)->findAll();
                break;

            case "Video":
                $data = $this->entityManager->getRepository(VideoEntity::class)->findAll();
                break;

            case "Clap":
                $data = $this->entityManager->getRepository(ClapEntity::class)->findAll();
                break;

            case "Comment":
                $data = $this->entityManager->getRepository(CommentEntity::class)->findAll();
                break;
        }
        return $data;
    }


    public function getArtistPaintings(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return $data = $this->entityManager->getRepository(PaintingEntity::class)->findByArtist($data['artist']);
    }
    public function getPaintingById(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return $data = $this->entityManager->getRepository(PaintingEntity::class)->find($data['painting']);
    }

    public function getPaintingImages(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        return $data = $this->entityManager->getRepository(ImageEntity::class)->findByPainting($data['painting']);
    }
}