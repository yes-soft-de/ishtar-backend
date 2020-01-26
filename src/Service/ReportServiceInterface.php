<?php

namespace App\Service;

use App\Response\GetArtistsDetailsResponse;

interface ReportServiceInterface
{
    public function saveReports($request);

    public function sendReports();

    public function isEmailExists(GetArtistsDetailsResponse $artist);

    public function isReportSent($artist);

    public function createReport($artist);

    public function getInteractions($entity, $row, $interaction);

    public function getComments($entity, $row);

    public function getClaps($entity, $row);
}