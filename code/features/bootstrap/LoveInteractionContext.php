<?php

trait LoveInteractionContext
{
    private $userId;
    private $paintingId;
    private $paintingLoves;

    /**
     * @Given /^I Am On Specific Painting With Id Of "([^"]*)"$/
     */
    public function iAmOnSpecificPaintingWithIdOf($arg1)
    {
        $this->paintingId = $arg1;
    }

    /**
     * @Given /^I Saw How Many Loves On A Painting$/
     */
    public function iSawHowManyLovesOnAPainting()
    {
        $common = new IshtarCommon();
        $this->paintingLoves = $common->getPaintingLoves($this->paintingId);
        if (is_integer($this->paintingLoves) || is_string($this->paintingLoves)) {
            return true;
        } else {
            return new Exception('Illegal Painting Loves Type');
        }
    }

    /**
     * @When /^I Love The Painting$/
     */
    public function ILoveThePainting()
    {
        $factory = new RequestFactory();

        $this->response = $this->client->post(
            IshtarConfig::$BASE_API . IshtarConfig::$INTERACTION_CREATE_ENDPOINT, [
                'json' => $factory->createPaintingLove(
                    $this->userId,
                    $this->paintingId
                )
            ]
        );
    }

    /**
     * @Then /^The Loves On The Painting Should Be Increased By "([^"]*)"$/
     */
    public function theLovesOnThePaintingShouldBeIncreasedBy($arg1)
    {
        $common = new IshtarCommon();
        $newLoves = $common->getPaintingLoves($this->paintingId);
        if ($this->paintingLoves - $newLoves == 1) {
            return true;
        } else {
            return new Exception("This Result is Not Accepted Old Loves: " . $this->paintingLoves .
                " new Loves: " . $newLoves, -2);
        }
    }

    /**
     * @Given /^I Requested A Painting List$/
     */
    public function iRequestedAPaintingList()
    {
        $this->response = $this->client->get(
            IshtarConfig::$BASE_API . IshtarConfig::$PAINTING_QUERY_ENDPOINT
        );
    }

    /**
     * @When /^I Love A Painting From The List$/
     */
    public function iLoveAPaintingFromTheList()
    {

        $factory = new RequestFactory();

        $this->response = $this->client->post(
            IshtarConfig::$BASE_API . IshtarConfig::$INTERACTION_CREATE_ENDPOINT, [
                'json' => $factory->createPaintingLove(
                    $this->userId,
                    $this->paintingId
                )
            ]
        );
    }

    /**
     * @Given /^I Am A NOT Signed In User$/
     */
    public function iAmANOTSignedInUser()
    {
        $this->userId = null;
    }

    /**
     * @Given /^I Should Get A Response Explaining That I Should Login$/
     */
    public function iShouldGetAResponseExplainingThatIShouldLogin()
    {
        $responseCode = $this->response->getStatusCode();

        if ($responseCode == 403) {
            return;
        } else {
            throw new Exception('Fake Status Code?!! ' . $responseCode .
            'Response Data: ' . json_encode($this->response->getBody()->getContents()));
        }
    }

    /**
     * @When /^I Select One Of The Paintings$/
     */
    public function iSelectOneOfThePaintings()
    {
        $json = json_decode($this->response->getBody()->getContents());
        $randomIndex = rand(0, count($json->Data)-1);
        $this->paintingId = $json->Data[$randomIndex]->id;
    }

    /**
     * @Given /^I Am A Hacker Having A Bad User Id Of "([^"]*)"$/
     */
    public function iAmAHackerHavingABadUserIdOf($arg1)
    {
        $this->userId = $arg1;
    }


}
