<?php

use Behat\Behat\Context\Context;
use GuzzleHttp\Client;


/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
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

    use ArtistListQueryContext;
    use ArtistQueryContext;
    use PaintingListQueryContext;
    use PaintingQueryContext;
    use LoginContext;
    use LoveInteractionContext;
    use FollowInteractionContext;
    use ViewInteractionContext;

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
            return new Exception("Status Code Error", -1);
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

    /**
     * @Given /^I Am A Signed In User Of Id "([^"]*)"$/
     */
    public function iAmASignedInUserOfId($arg1)
    {
        $this->userId = $arg1;
    }
}
