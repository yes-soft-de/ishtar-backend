Feature: Artists Getting Features
  The Artist Query Endpoint should be able to give us
  1. Artist List

  Scenario: Getting Artist List
    Given I Have Access To Backend
    When I Request Artist List
    Then I Should Get a Response Code of "200"
    Then I Should Get Valid JSON Response
