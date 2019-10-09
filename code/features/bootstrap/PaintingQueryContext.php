<?php


trait PaintingQueryContext
{
    private $request;
    private $response;
    private $client;

    /**
     * @Given /^I Have A Valid Painting Id$/
     */
    public function iHaveAValidPaintingId()
    {
        $request_factory = new RequestFactory();
        $this->request = $request_factory->prepareRequestWithArtistId("1");
    }

    /**
     * @Given /^I Have A Invalid Painting Id$/
     */
    public function iHaveAInvalidPaintingId()
    {
        $request_factory = new RequestFactory();
        $this->request = $request_factory->prepareRequestWithArtistId("-1");
    }

    /**
     * @When /^I Request Painting$/
     */
    public function iRequestPainting()
    {
        $this->response = $this->client->post(
            IshtarConfig::$BASE_API . IshtarConfig::$PAINTING_QUERY_BY_ID_ENDPOINT,
            $this->request
        );
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
     * @Then /^I Should Get A Valid Painting Name$/
     */
    public function iShouldGetAValidPaintingName()
    {
        $json_object = json_decode( $this->response->getBody()->getContent());

        if ($json_object['Data']['Name'] == null) {
            throw new Exception('Error Reading Name!');
        }

    }

}
