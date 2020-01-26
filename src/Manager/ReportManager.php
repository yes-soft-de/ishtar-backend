<?php


namespace App\Manager;


use App\AutoMapping;
use App\Entity\ReportEntity;
use App\Repository\ArtistEntityRepository;
use App\Repository\ReportRepository;
use App\Request\SaveReportRequest;
use App\Response\ArtistReport;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraints\Date;

class ReportManager
{
    private $autoMapping;
    private $reportRepository;
    private $entityManager;
    private $artistRepository;

    /**
     * ReportManager constructor.
     * @param $autoMapping
     * @param $reportRepository
     */
    public function __construct(AutoMapping $autoMapping,ReportRepository $reportRepository,
                                EntityManagerInterface $entityManagerInterface,ArtistEntityRepository $artistRepository)
    {
        $this->autoMapping = $autoMapping;
        $this->reportRepository = $reportRepository;
        $this->entityManager=$entityManagerInterface;
        $this->artistRepository=$artistRepository;
    }

    public function saveReport(SaveReportRequest $request)
    {
        $request->setArtist($this->artistRepository->find($request->getId()));
        $request->setSendingDate(new \DateTime('Now'));
        $report=$this->autoMapping->map(SaveReportRequest::class,ReportEntity::class,$request);
        $this->entityManager->persist($report);
        $this->entityManager->flush();
        return $report;
    }
}