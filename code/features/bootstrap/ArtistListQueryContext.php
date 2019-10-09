<?php

use GuzzleHttp\Client;

trait ArtistListQueryContext
{

    /**
     * @When /^I Request Artist List$/
     */
    public
    function iRequestArtistList()
    {
        $this->response = $this->client->get(IshtarConfig::$BASE_API . IshtarConfig::$ARTIST_QUERY_ENDPOINT);
    }



}
