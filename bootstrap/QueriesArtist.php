<?php

use GuzzleHttp\Client;

trait QueriesArtist
{
    /**
     * @Given /^I Have Access To The Artist By Id Endpoint$/
     */
    public function iHaveAccessToTheArtistByIdEndpoint()
    {
        $this->client = new Client([
            'base_uri' => ConfigLinks::$BASE_API,
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
            ConfigLinks::$BASE_API . ConfigLinks::$ARTIST_QUERY_BY_ID_ENDPOINT,
            [
                GuzzleHttp\RequestOptions::JSON => $this->request
            ]
        );
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
     * @Given /^The Json Should Contain Artist Name$/
     */
    public function theJsonShouldContainArtistName()
    {
        $json_response = $this->response->getBody()->getContents();
        if (strlen($json_response['Data']['name']) > 0) {
            throw new Exception('Name Error');
        }
    }

    /**
     * @Given /^I Have a Good Artist Id Of (\d+)$/
     */
    public function iHaveAGoodArtistIdOf($arg1)
    {
        $requestFactory = new RequestFactory();
        $this->request = $requestFactory->prepareRequestWithArtistId($arg1);
    }

    /**
     * @Given /^The Json Should Contain Valid Artist Name$/
     */
    public function theJsonShouldContainValidArtistName()
    {
        $json_object = json_decode( $this->response->getBody()->getContents(), true);

        if (strlen($json_object['Data']['Name']) > 0) {
            throw new Exception('Error Reading Name!');
        }
    }
}
