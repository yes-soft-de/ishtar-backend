<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use IshtarConfig;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    public $request;
    public $response;
    public $client;

    use ArtistListQueryContext;
    use ArtistQueryContext;
    use PaintingListQueryContext;
    use PaintingQueryContext;


    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
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
            throw new Exception("Status Code Error", -1);
        }
    }

    /**
     * @Given /^I Have Access To Backend$/
     */
    public function iHaveAccessToBackend()
    {
        $this->client = new Client([
            'base_uri' => IshtarConfig::$BASE_API,
            'timeout'  => 10.0,
        ]);
        return true;
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
