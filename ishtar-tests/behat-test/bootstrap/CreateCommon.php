<?php

use GuzzleHttp\Client;

trait CreateCommon
{
    /**
     * @Given /^I Have Access To Backend$/
     */
    public function iHaveAccessToBackend()
    {
        $this->httpClient = new Client([
            'base_uri' => ConfigLinks::$BASE_API,
            'timeout'  => 10.0,
        ]);
        return true;
    }

    /**
     * @Then /^I Should Get a Response Code of "([^"]*)"$/
     */
    public function iShouldGetAResponseCodeOf($arg1)
    {
        if ($this->response->getStatusCode() == $arg1)
            return;
        else {
            return new Exception("Status Code Error", -1);
        }
    }

    /**
     * @Given /^I Am NOT A Signed In Administrator$/
     */
    public function iAmNOTASignedInAdministrator()
    {
        $this->adminId = "-1";
    }

    /**
     * @Given /^I Am A Signed In Administrator$/
     */
    public function iAmASignedInAdministrator()
    {
        $this->adminId = "6";
    }

    /**
     * @Given /^I Have Client Id Without Signing In$/
     */
    public function iHaveClientIdWithoutSigningIn()
    {
        $this->adminId = "6";
    }

    /**
     * @Given /^I Am Not A Signed In Administrator$/
     */
    public function iAmNotASignedInAdministrator1()
    {
        $this->adminId = "999";
    }
}
