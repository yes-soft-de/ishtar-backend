<?php

trait CreatePainting
{
    /**
     * @var array $painting
     */
    private $painting;

    /**
     * @Given /^I Have A Valid Painting Data$/
     */
    public function iHaveAValidPaintingData()
    {
        $factory = new RequestFactory();

        $this->painting = $factory->prepareCreatePaintingRequestPayload();

    }

    /**
     * @When /^I Request Painting Create With The Data I Have$/
     */
    public function iRequestPaintingCreateWithTheDataIHave()
    {
        $this->response = $this->httpClient->post(
            ConfigLinks::$BASE_API . ConfigLinks::$CREATE_PAINTING_ENDPOINT,
            [
                "json" => $this->painting
            ]
        );
    }

    /**
     * @Then /^I Should Find The Newly Created Painting In The Painting List$/
     * @throws Exception
     */
    public function iShouldFindTheNewlyCreatedPaintingInThePaintingList()
    {
        // First we Request the Painting List, Then we Check For our painting
        $res = $this->httpClient->get(ConfigLinks::$BASE_API . ConfigLinks::$ARTIST_QUERY_ENDPOINT);
        $json = json_decode($res->getBody()->getContents())->Data;

        foreach ($json as $item) {
            if ($this->painting["name"] == $item->name)
                return true;
            else echo $this->painting["name"] . " != " .  $item->name;
        }

        throw new Exception('Painting Was Not Found in the response');
    }

    /**
     * @Given /^I Have Painting Data Without Painting Name$/
     */
    public function iHavePaintingDataWithoutPaintingName()
    {
        $this->painting->name = null;

        $this->response = $this->httpClient->post(
            ConfigLinks::$BASE_API . ConfigLinks::$CREATE_PAINTING_ENDPOINT,
            [
                "json" => $this->painting
            ]
        );
    }

    /**
     * @Then /^I Should Get A Response Explaining The Error$/
     */
    public function iShouldGetAResponseExplainingTheError()
    {
        $json = json_decode($this->response->getBody()->getContents());
        if ($json->msg == "fetched Successfully"){
            throw new Exception('Deceiving Msg! ' . $json->msg);
        }
    }

    /**
     * @Then /^The Painting Data Found Matches The Painting Data$/
     * @throws Exception
     */
    public function thePaintingDataFoundMatchesThePaintingData()
    {
        $res = $this->httpClient->get(
            ConfigLinks::$BASE_API . ConfigLinks::$ARTIST_QUERY_ENDPOINT);
        $json = json_decode( $res->getBody()->getContents() );

        foreach ($json->Data as $item) {
            if (json_encode($item) == json_encode($this->painting))
                return true;
        }
        throw new Exception('Cant Find Created Painting Data');
    }
}
