<?php


use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\ResponseInterface;

trait LoginCommon
{

    public $request;

    /**
     * @var ResponseInterface $response
     */
    public $response;

    /**
     * @var GuzzleHttp\Client $client
     */
    public $client;

    /**
     * @var string $token
     */
    public $token;

    /**
     * @var ObjectUser $user
     */
    public $user;

    /**
     * @Given /^I Have Access To Backend$/
     */
    public function iHaveAccessToBackend(): bool
    {

        $this->client = new Client([
            'base_uri' => ConfigLinks::$BASE_API,
            'timeout' => 10.0,
        ]);
        return true;
    }

    /**
     * @Given /^I Have A Valid User Name And Password$/
     */
    public function iHaveAValidUserNameAndPassword(): void
    {
        $factory = new RequestFactory();

        $this->request = $factory->prepareLoginPayload(
            'Mohammad@Gmail.com',
            'M0h@mm@d');
    }

    /**
     * @When /^I Request Login$/
     */
    public function iRequestLogin(): void
    {
        $this->response = $this->client->post(
            ConfigLinks::$BASE_API . ConfigLinks::$LOGIN_ENDPOINT,
            [
                'http_errors' => false,
                'json' => $this->request
            ]
        );
    }

    /**
     * @Then /^I Should Get A Valid Json Response$/
     */
    public function iShouldGetAValidJsonResponse(): void
    {
        if (!ValidatorCommon::isValidJson($this->response)) {
            throw new Exception('Not a valid JSON Response: ');
        }
    }

    /**
     * @Given /^I Should Get A Login Token In The JSON$/
     */
    public function iShouldGetALoginTokenInTheJSON(): void
    {
        $json = json_decode($this->response->getBody()->getContents(), true);
        $this->token = $json['token'];
    }

    /**
     * @Given /^My Email Is "([^"]*)"$/
     * @param $username
     */
    public function myEmailIs($username): void
    {
        $this->user = new ObjectUser();
        $this->user->setUsername($username);
    }

    /**
     * @Given /^My Password Is "([^"]*)"$/
     * @param $password
     */
    public function myPasswordIs($password): void
    {
        $this->user->setPassword($password);

        $factory = new RequestFactory();

        $this->request = $factory->prepareLoginPayload(
            $this->user->getUsername(),
            $this->user->getPassword()
        );
    }

    /**
     * @When /^I Request Register New User$/
     */
    public function iRequestRegisterNewUser(): void
    {
        $factory = new RequestFactory();

        $this->response = $this->client->post(
            ConfigLinks::$BASE_API . ConfigLinks::$REGISTER_ENDPOINT,
            [
                'json' => $factory->prepareRegisterPayload(
                    $this->user->getUsername(),
                    $this->user->getPassword()),
                'http_errors' => false
            ]
        );
    }

    /**
     * @Then /^I Should Get A Response Explaining Success$/
     */
    public function iShouldGetAResponseExplainingSuccess(): void
    {
        if ($this->response->getStatusCode() !== 200) {
            throw new Exception('Error in Status Code');
        }
    }

    /**
     * @Given /^I Am A Registered User$/
     */
    public function iAmARegisteredUser(): void
    {
        $this->user = new ObjectUser();
        $this->user->setUsername('Mohammad@Gmail.com');
        $this->user->setPassword('M0h@mm@d');
    }

    /**
     * @When /^I Request Register With The Same Email Address$/
     */
    public function iRequestRegisterWithTheSameEmailAddress(): void
    {
        $factory = new RequestFactory();
        $this->response = $this->client->post(
            ConfigLinks::$BASE_API . ConfigLinks::$REGISTER_ENDPOINT,
            [
                'json' => $factory->prepareRegisterPayload(
                    $this->user->getUsername(),
                    $this->user->getPassword()
                )
            ]
        );
    }

    /**
     * @Then /^I Should Get A Response Explaining The Registration Error$/
     * @throws Exception
     */
    public function iShouldGetAResponseExplainingTheRegistrationError(): bool
    {
        $json = json_decode($this->response->getBody()->getContents(), true);

        if (strpos($json['message'], 'This value is already used') !== false) {
            return true;
        }

        throw new Exception('Error Compiling the Response or Bad Response' . $this->response->getBody());
    }

    /**
     * @Given /^I Am NOT A Registered User$/
     */
    public function iAmNOTARegisteredUser()
    {
        $conn = new mysqli('localhost', 'root', '', 'big_step', '3306');
        if ($this->user !== null) {
            $conn->query('DELETE FROM clients WHERE 1 = 1');
        }
    }

    /**
     * @Then /^I Should Get A Response That Contains "([^"]*)"$/
     */
    public function iShouldGetAResponseThatContains($arg1)
    {
        $json = json_decode($this->response->getBody()->getContents(), true);

        if ($json['message'] === $arg1) {
            return true;
        }

        throw new Exception('Error! Response: ' . $json['message']);
    }
}
