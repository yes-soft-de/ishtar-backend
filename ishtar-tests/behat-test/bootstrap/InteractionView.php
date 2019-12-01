<?php

trait InteractionView
{
    private $userId;
    private $paintingId;
    private $paintingViews;

    /**
     * @Given /^I Saw How Many Views On A Painting$/
     */
    public function iSawHowManyViewsOnAPainting()
    {
        $common = new InteractionCommonFactory();
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
            configLinks::$BASE_API . configLinks::$INTERACTION_CREATE_ENDPOINT, [
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
        $common = new InteractionCommonFactory();
        $newViews = $common->getPaintingViews($this->paintingId);
        if ($this->paintingViews - $newViews == 1) {
            return true;
        } else {
            return new Exception("This Result is Not Accepted Old Views: " . $this->paintingViews .
                " new Views: " . $newViews, -2);
        }
    }

    /**
     * @When /^I View A Painting From The List$/
     */
    public function iViewAPaintingFromTheList()
    {

        $factory = new RequestFactory();

        $this->response = $this->client->post(
            configLinks::$BASE_API . configLinks::$INTERACTION_CREATE_ENDPOINT, [
                'json' => $factory->createPaintingView(
                    $this->userId,
                    $this->paintingId
                )
            ]
        );
    }
}
