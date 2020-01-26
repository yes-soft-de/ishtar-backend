<?php


namespace App\Manager;

use App\Repository\ClapEntityRepository;
use App\Repository\CommentEntityRepository;
use App\Repository\EntityInteractionEntityRepository;
use App\Request\DeleteRequest;
use Doctrine\ORM\EntityManagerInterface;

class InteractionsManager
{
    private $entityManager;
    private $commentRepository;
    private $entityInteractionRepository;
    private $clapRepository;

    public function __construct(EntityManagerInterface $entityManagerInterface,EntityInteractionEntityRepository
    $interactionEntityRepository,CommentEntityRepository $commentRepository,ClapEntityRepository $clapRepository)
    {
        $this->entityManager = $entityManagerInterface;
        $this->entityInteractionRepository=$interactionEntityRepository;
        $this->clapRepository=$clapRepository;
        $this->commentRepository=$commentRepository;
    }

    public function deleteInteractions(DeleteRequest $request,$entity)
    {
        $id = $request->getId();
        $interactions = $this->entityInteractionRepository->getEntityInteraction($entity, $id);
        if ($interactions) {
        foreach ($interactions as $interaction)
            $this->entityManager->remove($interaction);
        $this->entityManager->flush();
    }
        else
        {
            $exception = new EntityException();
            $exception->entityNotFound($entity);
        }
    }
    public function deleteComments(DeleteRequest $request,$entity)
    {
        $id=$request->getId();
        $Comments = $this->commentRepository->getEntity($entity, $id);
        foreach ($Comments as $comment)
            $this->entityManager->remove($comment);
        $this->entityManager->flush();

    }
    public function deleteClaps(DeleteRequest $request,$entity)
    {
        $id=$request->getId();
        $Claps = $this->clapRepository->getEntity($entity, $id);
        foreach ($Claps as $clap)
            $this->entityManager->remove($clap);
        $this->entityManager->flush();
    }
}
