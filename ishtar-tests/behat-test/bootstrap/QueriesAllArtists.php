<?php

trait QueriesAllArtists
{
    /**
     * @When /^I Request Artist List$/
     */
    public function iRequestArtistList()
    {
        $this->response = $this->client->get(ConfigLinks::$BASE_API . ConfigLinks::$ARTIST_QUERY_ENDPOINT);
    }
}
