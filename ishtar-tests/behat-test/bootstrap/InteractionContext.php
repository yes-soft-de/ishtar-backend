<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class InteractionContext implements Context
{

    /**
     * @var GuzzleHttp\Client $client
     */
    private $client;

    /**
     * @var \Psr\Http\Message\ResponseInterface $request
     */
    private $request;

    /**
     * @var $response
     */
    private $response;


    /**
     * @var String $userId
     */
    private $userId;

    /**
     * @var String $paintingId
     */
    private $paintingId;

    /**
     * @var String $paintingLoves
     */
    private $paintingLoves;

    public function __construct()
    {
    }

    use InteractionCommon;


    use InteractionLove;
    use InteractionFollow;
    use InteractionView;
}
