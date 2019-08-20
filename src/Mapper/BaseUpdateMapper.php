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


class BaseUpdateMapper implements BaseUpdateMapperInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updateMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity) {
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
                    $this->entityManager->getRepository(PaintingEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Client":
                $clientMapper = new ClientMapper();
                return $clientMapper->clientData($data,
                    $this->entityManager->getRepository(ClientEntity::class)->findOneById($data["id"]));
                break;

            case "Interaction":
                $interactionMapper = new InteractionMapper();
                return $interactionMapper->interactionData($data,
                    $this->entityManager->getRepository(InteractionEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Auction":
                $auctionMapper = new AuctionMapper();
                return $auctionMapper->auctionData($data,
                    $this->entityManager->getRepository(AuctionEntity::class)->findOneById($data["id"]));
                break;

            case "AuctionPainting":
                $auctionPaintingMapper = new AuctionPaintingMapper();
                return $auctionPaintingMapper->auctionPaintingData($data,
                    $this->entityManager->getRepository(AuctionPaintingEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "ArtistArtType":
                $artistArtTypeMapper = new ArtistArtTypeMapper();
                return $artistArtTypeMapper->artistArttypeData($data,
                    $this->entityManager->getRepository(ArtistArtTypeEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "PaintingTransaction":
                $paintingTransactionMapper = new PaintingTransactionMapper();
                return $paintingTransactionMapper->paintingTransactionData($data,
                    $this->entityManager->getRepository(PaintingTransactionEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Image":
                $imageMapper = new ImageMapper();
                return $imageMapper->ImageData($data,
                    $this->entityManager->getRepository(ImageEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Video":
                $videoMapper = new VideoMapper();
                return $videoMapper->VideoData($data,
                    $this->entityManager->getRepository(VideoEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Clap":
                $clapMapper = new ClapMapper();
                return $clapMapper->ClapData($data,
                    $this->entityManager->getRepository(ClapEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;

            case "Comment":
                $commentMapper = new CommentMapper();
                return $commentMapper->CommentData($data,
                    $this->entityManager->getRepository(CommentEntity::class)->findOneById($data["id"]), $this->entityManager);
                break;


        }
    }


}
