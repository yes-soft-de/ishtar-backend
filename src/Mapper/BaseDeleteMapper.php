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


class BaseDeleteMapper implements BaseDeleteMapperInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function deleteMapper(Request $request, $entity)
    {
        $data = json_decode($request->getContent(), true);

        switch ($entity) {
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