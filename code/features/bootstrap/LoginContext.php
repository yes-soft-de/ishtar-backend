<?php

/**
 * Trait LoginContext
 */
trait LoginContext
{

    /**
     * @When /^I Request Login$/
     */
    public function iRequestLogin()
    {
        $this->client->get(IshtarConfig::$BASE_API . IshtarConfig::$LOGIN, ['verify' => true]);
    }

    /**
     * @Then /^I Dont Know What$/
     */
    public function iDontKnowWhat()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
