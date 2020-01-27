<?php

trait QueriesAllPainting
{
    /**
     * @When /^I Request Painting List$/
     */
    public function iRequestPaintingList()
    {
        $this->response = $this->client->get(ConfigLinks::$BASE_API . ConfigLinks::$PAINTING_QUERY_ENDPOINT);
    }
}
