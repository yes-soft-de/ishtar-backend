<?php

use GuzzleHttp\Client;

trait PaintingListQueryContext
{
    private $request;
    private $response;
    private $client;

    /**
     * @Given /^I Have Access To Backend$/
     */
    public function iHaveAccessToBackend()
    {
        $this->client = new Client([
            'base_uri' => IshtarConfig::$BASE_API,
            'timeout'  => 2.0,
        ]);
        return true;
    }

    /**
     * @When /^I Request Painting List$/
     */
    public function iRequestPaintingList()
    {
        $this->response = $this->client->get(IshtarConfig::$BASE_API . IshtarConfig::$PAINTING_QUERY_ENDPOINT);
    }

    /**
     * @Then /^I Should Get a Response Code of "([^"]*)"$/
     */
    public function iShouldGetAResponseCodeOf($arg1)
    {
        if ($this->response->getStatusCode() == $arg1)
            return;
        else {
            throw new Exception("Status Code Error", -1);
        }
    }

    /**
     * @Then /^I Should Get Valid JSON Response$/
     */
    public function iShouldGetValidJSONResponse()
    {
        $ishtarCommon = new IshtarCommon();
        if ($ishtarCommon->isValidJson($this->response) != true) {
            throw new Exception('JSON Format Error ' . $ishtarCommon->isValidJson($this->response));
        }
    }
}
