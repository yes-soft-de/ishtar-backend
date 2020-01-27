<?php


trait CreateArtist
{
    /**
     * @var array $artist
     */
    private $artist;

    /**
     * @Given /^I Have A Valid Artist Data$/
     */
    public function iHaveAValidArtistData()
    {
        $factory = new RequestFactory();

        $this->artist = $factory->prepareCreateArtistRequestPayload();

    }

    /**
     * @When /^I Request Artist Create With The Data I Have$/
     */
    public function iRequestArtistCreateWithTheDataIHave()
    {
        $this->response = $this->httpClient->post(
            ConfigLinks::$BASE_API . ConfigLinks::$CREATE_ARTIST_ENDPOINT,
            [
                "json" => $this->artist
            ]
        );
    }

    /**
     * @Then /^I Should Find The Newly Created Artist In The Artist List$/
     * @throws Exception
     */
    public function iShouldFindTheNewlyCreatedArtistInTheArtistList()
    {
        // First we Request the Artist List, Then we Check For our artist
        $res = $this->httpClient->get(ConfigLinks::$BASE_API . ConfigLinks::$ARTIST_QUERY_ENDPOINT);
        $json = json_decode($res->getBody()->getContents())->Data;

        foreach ($json as $item) {
            if ($this->artist["name"] == $item->name)
                return true;
            else echo $this->artist["name"] . " != " .  $item->name;
        }

        throw new Exception('Artist Was Not Found in the response');
    }

    /**
     * @Given /^I Have Artist Data Without Artist Name$/
     */
    public function iHaveArtistDataWithoutArtistName()
    {
        $this->artist->name = null;

        $this->response = $this->httpClient->post(
            ConfigLinks::$BASE_API . ConfigLinks::$CREATE_ARTIST_ENDPOINT,
            [
                "json" => $this->artist
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
     * @Then /^The Artist Data Found Matches The Artist Data$/
     * @throws Exception
     */
    public function theArtistDataFoundMatchesTheArtistData()
    {
        $res = $this->httpClient->get(
            ConfigLinks::$BASE_API . ConfigLinks::$ARTIST_QUERY_ENDPOINT);
        $json = json_decode( $res->getBody()->getContents() );

        foreach ($json->Data as $item) {
            if (json_encode($item) == json_encode($this->artist))
                return true;
        }
        throw new Exception('Cant Find Created Artist Data');
    }
}
