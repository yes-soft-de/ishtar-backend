Feature: Get Artist List
  The Get Artist By id should Return a Valid JSON
  Object

  Scenario:
    Given I Have a Good Artist Id Of 1
    And I Have Access To The Artist By Id Endpoint
    When I Request Artist By Id
    Then I Should Get a Response Code of "200"
    And I Should Get Valid JSON Response
    And The Json Should Contain Valid Artist Name

  Scenario:
    Given I Have a Bad Artist Id Of 100
    And I Have Access To The Artist By Id Endpoint
    When I Request Artist By Id
    Then I Should Get a Response Code of "200"
    And I Should Get Valid JSON Response
    And The Json Should Contain Null Data Field
    And The Json Should Contain Message Of No Artist Found

