<?php

use GuzzleHttp\Client;

/**
 * Created by PhpStorm.
 * User: TEC-GATE
 * Date: 2019/10/23
 * Time: 5:59 PM
 */

trait QueriesCommon
{
    public $request;

    /**
     * @var GuzzleHttp\Psr7\Response
     */
    public $response;

    /**
     * @var GuzzleHttp\Client $client
     */
    public $client;

    use QueriesAllArtists;
    use QueriesArtist;

    public function __construct()
    {
    }

    /**
     * @Then /^I Should Get a Response Code of "([^"]*)"$/
     */
    public function iShouldGetAResponseCodeOf($arg1)
    {
        if ($this->response->getStatusCode() == $arg1)
            return;
        else {
            return new Exception("Status Code Error", -1);
        }
    }

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
     * @Then /^I Should Get Valid JSON Response$/
     */
    public function iShouldGetValidJSONResponse()
    {
        if (ValidatorCommon::isValidJson($this->response) != true) {
            throw new Exception('JSON Format Error ' . ValidatorCommon::isValidJson($this->response));
        }
    }

    /**
     * @Given /^I Am A Signed In User Of Id "([^"]*)"$/
     */
    public function iAmASignedInUserOfId($arg1)
    {
        $this->userId = $arg1;
    }
}
