<?php

use GuzzleHttp\Client;

trait ArtistQueryContext
{

    private $request;
    private $response;
    private $client;

    /**
     * @Given /^I Have Access To The Artist By Id Endpoint$/
     */
    public function iHaveAccessToTheArtistByIdEndpoint()
    {
        $this->client = new Client([
            'base_uri' => IshtarConfig::$BASE_API,
            'timeout' => 2.0,
        ]);
    }

    /**
     * @Given /^I Have a Bad Artist Id Of (\d+)$/
     * @param $arg1
     */
    public function iHaveABadArtistIdOf($arg1)
    {
        $request_factory = new RequestFactory();
        $this->request = $request_factory->prepareRequestWithArtistId($arg1);
    }

    /**
     * @When /^I Request Artist By Id$/
     */
    public function iRequestArtistById()
    {
        $this->response = $this->client->post(
            IshtarConfig::$BASE_API . IshtarConfig::$ARTIST_QUERY_BY_ID_ENDPOINT,
            $this->request
        );
    }

    /**
     * @Then /^I Should Get A Valid JSON$/
     */
    public function iShouldGetAValidJSON()
    {
        $common = new IshtarCommon();
        if ($common->isValidJson($this->response) != true) {
            throw new Exception('Error in JSON: ' . $common->isValidJson($this->response));
        }
    }

    /**
     * @Then /^The Json Should Contain Artist Name Of "([^"]*)"$/
     */
    public function theJsonShouldContainArtistNameOf($arg1)
    {
        $json_response = $this->response->getBody()->getContents();
        $response = json_decode($json_response);
        if ($response["Data"]["Name"] == $arg1) {
            return true;
        } else {
            throw new Exception("Artist Name is Incorrect");
        }
    }

    /**
     * @Then /^The Json Should Contain Message Of No Artist Found$/
     */
    public function theJsonShouldContainMessageOfNoArtistFound()
    {
        $json_response = $this->response->getBody()->getContents();
        $response = json_decode($json_response);
        if ($response["msg"] == "No Artist Found") {
            return true;
        } else {
            throw new Exception("Message is Deceiving");
        }
    }

    /**
     * @Then /^The Json Should Contain Null Data Field$/
     */
    public function theJsonShouldContainNullDataField()
    {
        $json_response = $this->response->getBody()->getContents();
        $response = json_decode($json_response);
        if ($response["Data"] == null) {
            return true;
        } else {
            throw new Exception("Data Load is incorrect");
        }
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
}
