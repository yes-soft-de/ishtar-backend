<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Psr\Http\Message\ResponseInterface;

/**
 * Defines application features from the specific context.
 */
class ProtectedContext implements Context
{

    public $request;

    /**
     * @var ResponseInterface $response
     */
    public $response;

    /**
     * @var GuzzleHttp\Client $client
     */
    public $client;

    /**
     * @var string $token
     */
    public $token;

    /**
     * @var ObjectUser $user
     */
    public $user;

    /**
     * @var string $userId
     */
    public $userId;

    /**
     * @var int $loveNumber
     */
    public $loveNumber;

    /**
     * @var int $paintingId
     */
    public $paintingId;

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
     * @Given /^I Have Access To Backend$/
     */
    public function iHaveAccessToBackend(): bool
    {

        $this->client = new Client([
            'base_uri' => ConfigLinks::$BASE_API,
            'timeout' => 10.0,
            'cookies' => true
        ]);
        return true;
    }

    /**
     * @Given /^I Am A Registered User$/
     */
    public function iAmARegisteredUser(): void
    {
        $this->user = new ObjectUser();
        $this->user->setUsername('Mohammad@Gmail.com');
        $this->user->setPassword('M0h@mm@d');
    }

    /**
     * @Given /^I Am A Logged In User$/
     */
    public function iAmALoggedInUser()
    {
        // Login Here

        $factory = new RequestFactory();

        $this->response = $this->client->post(
            ConfigLinks::$BASE_API . ConfigLinks::$LOGIN_ENDPOINT,
            [
                'json' => $factory->prepareLoginPayload(
                    $this->user->getUsername(),
                    $this->user->getPassword()
                )
            ]
        );

        $json = json_decode($this->response->getBody()->getContents(), true);

        $this->token = $json['token'];

        $this->response = $this->client->get(
            ConfigLinks::$BASE_API . ConfigLinks::$USER_ENDPOINT,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token
                ]
            ]
        );

        $this->userId = json_decode($this->response->getBody()->getContents(), true)['Data']['id'];

    }

    /**
     * @Given /^I Am On A Painting Page Of Id "([^"]*)"$/
     */
    public function iAmOnAPaintingPageOfId($arg1)
    {
        $this->paintingId = $arg1;
    }

    /**
     * @Given /^The Painting Has A Certain Loves$/
     */
    public function thePaintingHasACertainLoves()
    {
        $res = $this->client->get(
            ConfigLinks::$BASE_API . ConfigLinks::$INTERACTION_GET_ENDPOINT . '/' .
            ConfigLinks::$ENTITY_TYPE_PAINTING . '/' . $this->paintingId . '/' . ConfigLinks::$INTERACTION_TYPE_LOVE
        );

        $json = json_decode($res->getBody()->getContents(), true);
        $this->loveNumber = $json['Data'][0]['interactions'];
    }

    /**
     * @When /^I Perform A Love$/
     */
    public function iPerformALove()
    {
        $factory = new RequestFactory();

        $this->response = $this->client->post(
            ConfigLinks::$BASE_API . ConfigLinks::$PAINTING_INTERACTION_GET_ENDPOINT ,
            [
                'json' => $factory->createPaintingLove($this->userId, $this->paintingId),
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token
                ]
            ]
        );
    }

    /**
     * @Then /^The Total Painting Loves Is Increased By "([^"]*)"$/
     */
    public function theTotalPaintingLovesIsIncreasedBy($arg1)
    {
        $res = $this->client->get(
            ConfigLinks::$BASE_API . ConfigLinks::$INTERACTION_GET_ENDPOINT . '/' .
            ConfigLinks::$ENTITY_TYPE_PAINTING . '/' . $this->paintingId . '/' . ConfigLinks::$INTERACTION_TYPE_LOVE
        );

        $json = json_decode($res->getBody()->getContents(), true);

        if ($this->loveNumber < $json['Data'][0]['interactions']) {
            return;
        }
        throw new Exception('Love was not registered! Before: ' . $this->loveNumber .
            ' after ' . $json['Data'][0]['interactions']);
    }
}
