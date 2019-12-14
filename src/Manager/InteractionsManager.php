<?php


namespace App\Manager;


use App\Entity\ClapEntity;
use App\Entity\CommentEntity;
use App\Entity\EntityInteractionEntity;
use App\Mapper\CommentMapper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class InteractionsManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManagerInterface)
    {
        $this->entityManager = $entityManagerInterface;
    }

    public function deleteInteractions($id,$entity)
    {
       // $id = $request->get('id');
        $interactions = $this->entityManager->getRepository(EntityInteractionEntity::class)->getEntityInteraction
        ($entity, $id);
        if ($interactions) {
        foreach ($interactions as $interaction)
            $this->entityManager->remove($interaction);
        $this->entityManager->flush();
    }
        else
        {
            $exception = new EntityException();
            $exception->entityNotFound("painting");
        }

    }
    public function deleteComments($id,$entity)
    {
      //  $id=$request->get('id');
        $Comments = $this->entityManager->getRepository(CommentEntity::class)->getEntity
        ($entity, $id);
        foreach ($Comments as $comment)
            $this->entityManager->remove($comment);
        $this->entityManager->flush();

    }
    public function deleteClaps($id,$entity)
    {
       // $id=$request->get('id');
        $Claps = $this->entityManager->getRepository(ClapEntity::class)->getEntity
        ($entity, $id);
        foreach ($Claps as $clap)
            $this->entityManager->remove($clap);
        $this->entityManager->flush();

    }
}
