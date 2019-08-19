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

class BaseMapper implements BaseMapperInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function createMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);
       switch ($entity)
        {
            case "Artist":
                $artistMapper = new ArtistMapper();
                $artistEntity = new ArtistEntity();
                return $artistMapper->artistData($data, $artistEntity);
                break;

            case "ArtType":
                $artTypeMapper = new ArtTypeMapper();
                $artTypeEntity = new ArtTypeEntity();
                return $artTypeMapper->artTypeData($data, $artTypeEntity);
                break;

            case "Painting":

                $paintingMapper = new PaintingMapper();
                $paintingEntity = new PaintingEntity();
                return $paintingMapper->PaintingData($data, $paintingEntity,$this->entityManager);
                break;

            case "Client":
                $clientMapper = new ClientMapper();
                $clientEntity = new ClientEntity();
                return $clientMapper->clientData($data, $clientEntity);
                break;

                case "Interaction":
                $interactionMapper = new InteractionMapper();
                $interactionEntity = new InteractionEntity();
                return $interactionMapper->interactionData($data,$interactionEntity,$this->entityManager);
                break;

            case "Auction":
                $auctionMapper = new AuctionMapper();
                $auctionEntity = new AuctionEntity();
                return $auctionMapper->auctionData($data, $auctionEntity);
                break;

            case "AuctionPainting":
                $auctionPaintingMapper = new AuctionPaintingMapper();
                $auctionPaintingEntity = new AuctionPaintingEntity();
                return $auctionPaintingMapper->auctionPaintingData($data, $auctionPaintingEntity,$this->entityManager);
                break;

                case "ArtistArtType":
                $artistArtTypeMapper = new ArtistArtTypeMapper();
                $artistArtTypeEntity = new ArtistArtTypeEntity();
                return $artistArtTypeMapper->artistArtTypeData($data, $artistArtTypeEntity,$this->entityManager);
                break;

            case "PaintingTransaction":
                $paintingTransactionMapper = new PaintingTransactionMapper();
                $paintingTransactionEntity = new PaintingTransactionEntity();
                return $paintingTransactionMapper->paintingTransactionData($data,$paintingTransactionEntity,$this->entityManager);
                break;

            case "Image":
                $imageMapper = new ImageMapper();
                $imageEntity = new ImageEntity();
                return $imageMapper->ImageData($data, $imageEntity,$this->entityManager);
                break;

            case "Video":
                $videoMapper = new VideoMapper();
                $videoEntity = new VideoEntity();
                return $videoMapper->VideoData($data, $videoEntity,$this->entityManager);
                break;

            case "Clap":
                $clapMapper = new ClapMapper();
                $clapEntity = new ClapEntity();
                return $clapMapper->clapData($data, $clapEntity,$this->entityManager);
                break;

            case "Comment":
                $commentMapper = new CommentMapper();
                $commentEntity = new CommentEntity();
                return $commentMapper->CommentData($data, $commentEntity,$this->entityManager);
                break;


        }
    }

    public function updateMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity)
        {
            case "Artist":
                $artistMapper = new ArtistMapper();
                return $artistMapper->artistData($data,
                    $this->entityManager->getRepository(ArtistEntity::class)->findOneById($data["id"]));
                break;

            case "ArtType":
                $artTypeMapper = new ArtTypeMapper();
                return $artTypeMapper->artTypeData($data,
                    $this->entityManager->getRepository(ArtTypeEntity::class)->findOneById($data["id"]));
                break;

            case "Painting":
                $paintingMapper = new PaintingMapper();
                return $paintingMapper->paintingData($data,
                    $this->entityManager->getRepository(PaintingEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;

            case "Client":
                $clientMapper = new ClientMapper();
                return $clientMapper->clientData($data,
                    $this->entityManager->getRepository(ClientEntity::class)->findOneById($data["id"]));
                break;

            case "Interaction":
                $interactionMapper = new InteractionMapper();
                return $interactionMapper->interactionData($data,
                    $this->entityManager->getRepository(InteractionEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;

            case "Auction":
                $auctionMapper = new AuctionMapper();
                return $auctionMapper->auctionData($data,
                    $this->entityManager->getRepository(AuctionEntity::class)->findOneById($data["id"]));
                break;

            case "AuctionPainting":
                $auctionPaintingMapper = new AuctionPaintingMapper();
                return $auctionPaintingMapper->auctionPaintingData($data,
                    $this->entityManager->getRepository(AuctionPaintingEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;

            case "ArtistArtType":
                $artistArtTypeMapper = new ArtistArtTypeMapper();
                return $artistArtTypeMapper->artistArttypeData($data,
                    $this->entityManager->getRepository(ArtistArtTypeEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;

            case "PaintingTransaction":
                $paintingTransactionMapper = new PaintingTransactionMapper();
                return $paintingTransactionMapper->paintingTransactionData($data,
                    $this->entityManager->getRepository(PaintingTransactionEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;

            case "Image":
                $imageMapper = new ImageMapper();
                return $imageMapper->ImageData($data,
                    $this->entityManager->getRepository(ImageEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;

            case "Video":
                $videoMapper = new VideoMapper();
                return $videoMapper->VideoData($data,
                    $this->entityManager->getRepository(VideoEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;

            case "Clap":
                $clapMapper = new ClapMapper();
                return $clapMapper->ClapData($data,
                    $this->entityManager->getRepository(ClapEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;

            case "Comment":
                $commentMapper = new CommentMapper();
                return $commentMapper->CommentData($data,
                    $this->entityManager->getRepository(CommentEntity::class)->findOneById($data["id"]),$this->entityManager);
                break;


        }
    }

    public function deleteMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity)
        {
            case "Artist":
                return $this->entityManager->getRepository(ArtistEntity::class)->findOneById($data["id"]);
                break;

            case "ArtType":
                return $this->entityManager->getRepository(ArtTypeEntity::class)->findOneById($data["id"]);
                break;

            case "Painting":
                return $this->entityManager->getRepository(PaintingEntity::class)->findOneById($data["id"]);
                break;

            case "Client":
                return $this->entityManager->getRepository(ClientEntity::class)->findOneById($data["id"]);
                break;

            case "Interaction":
                return $this->entityManager->getRepository(InteractionEntity::class)->findOneById($data["id"]);
                break;

            case "Auction":
                return $this->entityManager->getRepository(AuctionEntity::class)->findOneById($data["id"]);
                break;

            case "AuctionPainting":
                return $this->entityManager->getRepository(AuctionPaintingEntity::class)->findOneById($data["id"]);
                break;

            case "ArtistArtType":
                return $this->entityManager->getRepository(ArtistArtTypeEntity::class)->findOneById($data["id"]);
                break;

            case "PaintingTransaction":
                return $this->entityManager->getRepository(PaintingTransactionEntity::class)->findOneById($data["id"]);
                break;

            case "Image":
                return $this->entityManager->getRepository(ImageEntity::class)->findOneById($data["id"]);
                break;

            case "Video":
                return $this->entityManager->getRepository(VideoEntity::class)->findOneById($data["id"]);
                break;

            case "Clap":
                return $this->entityManager->getRepository(ClapEntity::class)->findOneById($data["id"]);
                break;

            case "Comment":
                return $this->entityManager->getRepository(CommentEntity::class)->findOneById($data["id"]);
                break;
        }
    }
}