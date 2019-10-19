<?php

/**
 * Trait ViewInteractionContext
 */
trait ViewInteractionContext
{
    private $userId;
    private $paintingId;
    private $paintingViews;

    /**
     * @Given /^I Am On Specific Painting With Id Of "([^"]*)"$/
     */
    public function iAmOnSpecificPaintingWithIdOf($arg1)
    {
        $this->paintingId = $arg1;
    }

    /**
     * @Given /^I Saw How Many Views On A Painting$/
     */
    public function iSawHowManyViewsOnAPainting()
    {
        $common = new IshtarCommon();
        $this->paintingViews = $common->getPaintingViews($this->paintingId);
        if (is_integer($this->paintingViews) || is_string($this->paintingViews)) {
            return true;
        } else {
            return new Exception('Illegal Painting Views Type');
        }
    }

    /**
     * @When /^I View The Painting$/
     */
    public function IViewThePainting()
    {
        $factory = new RequestFactory();

        $this->response = $this->client->post(
            IshtarConfig::$BASE_API . IshtarConfig::$INTERACTION_CREATE_ENDPOINT, [
                'json' => $factory->createPaintingView(
                    $this->userId,
                    $this->paintingId
                )
            ]
        );
    }

    /**
     * @Then /^The Views On The Painting Should Be Increased By "([^"]*)"$/
     */
    public function theViewsOnThePaintingShouldBeIncreasedBy($arg1)
    {
        $common = new IshtarCommon();
        $newViews = $common->getPaintingViews($this->paintingId);
        if ($this->paintingViews - $newViews == 1) {
            return true;
        } else {
            return new Exception("This Result is Not Accepted Old Views: " . $this->paintingViews .
                " new Views: " . $newViews, -2);
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
     * @When /^I View A Painting From The List$/
     */
    public function iViewAPaintingFromTheList()
    {

        $factory = new RequestFactory();

        $this->response = $this->client->post(
            IshtarConfig::$BASE_API . IshtarConfig::$INTERACTION_CREATE_ENDPOINT, [
                'json' => $factory->createPaintingView(
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
