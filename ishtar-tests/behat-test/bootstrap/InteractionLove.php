<?php

trait InteractionLove
{
    private $userId;
    private $paintingId;
    private $paintingLoves;

    /**
     * @Given /^I Saw How Many Loves On A Painting$/
     */
    public function iSawHowManyLovesOnAPainting()
    {
        $common = new InteractionCommonFactory();
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
            ConfigLinks::$BASE_API . ConfigLinks::$INTERACTION_CREATE_ENDPOINT, [
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
        $common = new InteractionCommonFactory();
        $newLoves = $common->getPaintingLoves($this->paintingId);
        if ($this->paintingLoves - $newLoves == 1) {
            return true;
        } else {
            return new Exception("This Result is Not Accepted Old Loves: " . $this->paintingLoves .
                " new Loves: " . $newLoves, -2);
        }
    }

    /**
     * @When /^I Love A Painting From The List$/
     */
    public function iLoveAPaintingFromTheList()
    {

        $factory = new RequestFactory();

        $this->response = $this->client->post(
            ConfigLinks::$BASE_API . ConfigLinks::$INTERACTION_CREATE_ENDPOINT, [
                'json' => $factory->createPaintingLove(
                    $this->userId,
                    $this->paintingId
                )
            ]
        );
    }
}
