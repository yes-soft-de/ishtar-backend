<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class CreateContext implements Context
{
    /**
     * @var GuzzleHttp\Client
     */
    private $httpClient;
    private $request;
    private $response;

    private $adminId;

    public function __construct()
    {
    }

    use CreateCommon;

    use CreateArtist;
    use CreatePainting;

}
