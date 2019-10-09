Feature: Get All Painting

  Scenario:
    Given I Have Access To Backend
    When I Request Painting List
    Then I Should Get a Response Code of "200"
    And I Should Get Valid JSON Response
