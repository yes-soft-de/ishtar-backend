<?php

trait InteractionFollow
{
    /**
     * @Given /^I Saw How Many Follows On A Painting$/
     */
    public function iSawHowManyFollowsOnAPainting()
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
     * @When /^I Follow The Painting$/
     */
    public function IFollowThePainting()
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
     * @Then /^The Follows On The Painting Should Be Increased By "([^"]*)"$/
     */
    public function theFollowsOnThePaintingShouldBeIncreasedBy($arg1)
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
     * @When /^I Follow A Painting From The List$/
     */
    public function iFollowAPaintingFromTheList()
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
