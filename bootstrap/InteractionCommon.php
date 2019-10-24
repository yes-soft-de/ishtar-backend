<?php

use GuzzleHttp\Client;

trait InteractionCommon
{


    /**
     * @Given /^I Have Access To Backend$/
     */
    public function iHaveAccessToBackend()
    {
        $this->client = new Client([
            'base_uri' => ConfigLinks::$BASE_API,
            'timeout'  => 10.0,
        ]);
        return true;
    }

    /**
     * @Given /^I Am A Signed In User Of Id "([^"]*)"$/
     */
    public function iAmASignedInUserOfId($arg1)
    {
        $this->userId = $arg1;
    }

    /**
     * @Given /^I Am On Specific Painting With Id Of "([^"]*)"$/
     */
    public function iAmOnSpecificPaintingWithIdOf($arg1)
    {
        $this->paintingId = $arg1;
    }

    /**
     * @Given /^I Requested A Painting List$/
     */
    public function iRequestedAPaintingList()
    {
        $this->response = $this->client->get(
            ConfigLinks::$BASE_API . ConfigLinks::$PAINTING_QUERY_ENDPOINT
        );
    }

    /**
     * @Given /^I Am A NOT Signed In User$/
     */
    public function iAmANOTSignedInUser()
    {
        $this->userId = null;
    }

    /**
     * @Given /^I Should Get A Response Explaining That I Should Login$/
     */
    public function iShouldGetAResponseExplainingThatIShouldLogin()
    {
        $responseCode = $this->response->getStatusCode();

        if ($responseCode == 403) {
            return;
        } else {
            throw new Exception('Fake Status Code?!! ' . $responseCode .
                'Response Data: ' . json_encode($this->response->getBody()->getContents()));
        }
    }

    /**
     * @When /^I Select One Of The Paintings$/
     */
    public function iSelectOneOfThePaintings()
    {
        $json = json_decode($this->response->getBody()->getContents());
        $randomIndex = rand(0, count($json->Data)-1);
        $this->paintingId = $json->Data[$randomIndex]->id;
    }

    /**
     * @Given /^I Am A Hacker Having A Bad User Id Of "([^"]*)"$/
     * @param $userId
     */
    public function iAmAHackerHavingABadUserIdOf($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @Then /^I Should Get a Response Code of "([^"]*)"$/
     * @param $resCode
     * @return Exception|void
     * @throws Exception
     */
    public function iShouldGetAResponseCodeOf($resCode)
    {
        if ($this->response->getStatusCode() == $resCode)
            return;
        else {
            throw new Exception("Status Code Error", -1);
        }
    }

    /**
     * @Then /^I Should Get Valid JSON Response$/
     * @throws Exception
     */
    public function iShouldGetValidJSONResponse()
    {
        if (ValidatorCommon::isValidJson($this->response) != true) {
            throw new Exception('JSON Format Error ' . ValidatorCommon::isValidJson($this->response));
        }
    }

}
