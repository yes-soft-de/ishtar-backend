<?php

trait QueriesPainting
{
    /**
     * @Given /^I Have A Valid Painting Id$/
     */
    public function iHaveAValidPaintingId()
    {
        $request_factory = new RequestFactory();
        $this->request = $request_factory->prepareRequestWithPaintingId("1");
    }

    /**
     * @Given /^I Have A Invalid Painting Id$/
     */
    public function iHaveAInvalidPaintingId()
    {
        $request_factory = new RequestFactory();
        $this->request = $request_factory->prepareRequestWithPaintingId("-1");
    }

    /**
     * @When /^I Request Painting$/
     */
    public function iRequestPainting()
    {
        $this->response = $this->client->post(
            ConfigLinks::$BASE_API . ConfigLinks::$PAINTING_QUERY_BY_ID_ENDPOINT,
            [
                'json' => $this->request
            ]
        );
    }

    /**
     * @Then /^I Should Get A Valid Painting Name$/
     */
    public function iShouldGetAValidPaintingName()
    {
        $json_object = json_decode( $this->response->getBody()->getContents(), true);

        if (strlen($json_object['Data']['Name']) > 0) {
            throw new Exception('Error Reading Name!');
        }

    }

}
