<?php

namespace App\Service;

use App\Response\GetArtistsDetailsResponse;

interface ReportServiceInterface
{
    public function saveReports($request);

    public function sendReportsToArtists();

    public function sendReportsToClients();

    public function isEmailExists(GetArtistsDetailsResponse $artist);

    public function isReportSent($artist);

    public function createArtistReport($artist);

    public function createClientReport($client);

    public function getInteractions($entity, $row, $interaction);

    public function getComments($entity, $row);

    public function getClaps($entity, $row);

    public function getMostViews();
}