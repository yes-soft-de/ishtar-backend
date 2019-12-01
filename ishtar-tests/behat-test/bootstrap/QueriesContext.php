<?php

use Behat\Behat\Context\Context;
use GuzzleHttp\Client;

/**
 * Defines application features from the specific context.
 */
class QueriesContext implements Context
{
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

    use QueriesCommon;

    use QueriesArtist;
    use QueriesAllArtists;
    use QueriesPainting;
    use QueriesAllPainting;
}
