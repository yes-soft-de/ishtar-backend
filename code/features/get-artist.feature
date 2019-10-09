Feature: Get Artist List
  The Get Artist By id should Return a Valid JSON
  Object

  Scenario:
    Given I Have a Bad Artist Id Of 100
    And I Have Access To The Artist By Id Endpoint
    When I Request Artist By Id
    Then I Should Get a Response Code of "200"
    And I Should Get A Valid JSON
    And The Json Should Contain Artist Name Of "Bashar Barazi"

  Scenario:
    Given I Have a Bad Artist Id Of 100
    And I Have Access To The Artist By Id Endpoint
    When I Request Artist By Id
    Then I Should Get a Response Code of "200"
    And I Should Get A Valid JSON
    And The Json Should Contain Message Of No Artist Found

  Scenario:
    Given I Have a Bad Artist Id Of 100
    And I Have Access To The Artist By Id Endpoint
    When I Request Artist By Id
    Then I Should Get a Response Code of "200"
    And I Should Get A Valid JSON
    And The Json Should Contain Null Data Field
