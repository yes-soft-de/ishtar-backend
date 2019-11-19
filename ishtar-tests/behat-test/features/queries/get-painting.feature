Feature: Get Painting by Id

  Scenario: Requesting Painting With Valid Id
    Given I Have Access To Backend
    And I Have A Valid Painting Id
    When I Request Painting
    Then I Should Get Valid JSON Response
    And I Should Get a Response Code of "200"
    And I Should Get A Valid Painting Name

  Scenario: Requesting Painting With Invalid Id
    Given I Have Access To Backend
    And I Have A Invalid Painting Id
    When I Request Painting
    Then I Should Get Valid JSON Response
    And I Should Get a Response Code of "200"
    And I Should Get A Valid Painting Name
