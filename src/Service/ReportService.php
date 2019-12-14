<?php


namespace App\Service;


use App\AutoMapping;
use App\Entity\ReportEntity;
use App\Manager\ArtistManager;
use App\Manager\ClapManager;
use App\Manager\CommentManager;
use App\Manager\EntityInteractionManager;
use App\Manager\ReportManager;
use App\Request\GetEntityRequest;
use App\Request\GetInterctionEntityRequest;
use App\Response\ArtistReport;
use App\Response\GetArtistsDetailsResponse;
use App\Response\GetInteractionsEntityResponse;
use App\Response\PaintingReportResponse;

class ReportService implements ReportServiceInterface
{
    private $entityInteractionManager;
    private $clapManager;
    private $commentManager;
    private $artistManager;
    private $artistService;
    private $autoMapping;
    private $reportManager;

    /**
     * ReportService constructor.
     * @param $entityInteractionManager
     * @param $clapManager
     * @param $commentManager
     * @param $artistManager
     */
    public function __construct(EntityInteractionManager $entityInteractionManager, ClapManager $clapManager,
                                CommentManager $commentManager, ArtistManager $artistManager, ArtistService $artistService
        , AutoMapping $autoMapping,ReportManager $reportManager)
    {
        $this->entityInteractionManager = $entityInteractionManager;
        $this->clapManager = $clapManager;
        $this->commentManager = $commentManager;
        $this->artistManager = $artistManager;
        $this->artistService = $artistService;
        $this->autoMapping = $autoMapping;
        $this->reportManager=$reportManager;
    }

    public function saveReports($request)
    {
        $result=$this->reportManager->saveReport($request);
        $result=$this->autoMapping->map(ReportEntity::class,ArtistReport::class,$result);
        return $result;
    }
    public function sendReports()
    {
        $artists=$this->artistService->getAllDetails();
        $counter=1;
        foreach ($artists as $artist)
        {
            if ( $this->isEmailExists($artist))
            {
                if(!$this->isReportSent($artist))
                {
                    $artistReports[$counter]=$this->autoMapping->map(GetArtistsDetailsResponse::class,
                        ArtistReport::class,$artist);
                   $artistReports[$counter]->setFollowers($this->GetInteractions(2,$artist->getId(),2));
                  $artistReports[$counter]->setEmailData($this->CreateReport($artist));
                  $artistReports[$counter]->setEmail($artist->getEmail());
                   $counter++;
                }
            }
        }
        return $artistReports;
    }

    public function isEmailExists(GetArtistsDetailsResponse $artist)
    {
        $email=$artist->getEmail();
        if(isset($email))
            return true;
        else return false;
    }
    public function isReportSent($artist)
    {
        $result=$this->artistManager->IsReportSent($artist);
        return $result;
    }
    public function createReport($artist)
    {
        $paintings=$this->artistManager->getArtistPaintings($artist->getId());
        foreach ($paintings as $painting)
            $paintingResponse[]=$this->autoMapping->map('array',PaintingReportResponse::class,$painting);
        foreach ($paintingResponse as $painting)
        {
            $viewed=$this->getInteractions(1,$painting->getId(),3);
            $likes=$this->getInteractions(1,$painting->getId(),1);
            $follower=$this->getInteractions(1,$painting->getId(),2);
            $comments=$this->getComments(1,$painting->getId());
            $claps=$this->getClaps(1,$painting->getId());
            $painting->setViewed($viewed);
            $painting->setLikes($likes);
            $painting->setFollower($follower);
            $painting->setComments($comments);
            $painting->setClaps($claps);
        }
        return $paintingResponse;
    }
    public function getInteractions($entity,$row,$interaction)
    {
        $request=new GetInterctionEntityRequest($entity,$row,$interaction);
        $response=$this->entityInteractionManager->getInteractions($request);
        $response=$this->autoMapping->map('array',GetInteractionsEntityResponse::class,$response[0]);
        return $response->getInteractions();
    }
    public function getComments($entity,$row)
    {
        $request=new GetEntityRequest($entity,$row);
        $response=$this->commentManager->getEntityComment($request);
        return count($response);
    }
    public function getClaps($entity,$row)
    {
        $request=new getEntityRequest($entity,$row);
        $response=$this->clapManager->getEntityclap($request);
        return count($response);
    }
}