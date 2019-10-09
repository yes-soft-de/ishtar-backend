<?php

use GuzzleHttp\Client;

trait PaintingListQueryContext
{

    /**
     * @When /^I Request Painting List$/
     */
    public function iRequestPaintingList()
    {
        $this->response = $this->client->get(IshtarConfig::$BASE_API . IshtarConfig::$PAINTING_QUERY_ENDPOINT);
    }



}
