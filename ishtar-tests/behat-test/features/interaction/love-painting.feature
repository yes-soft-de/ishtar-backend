Feature: Love Interaction
  Loving The Painting From a List, Loving it From Details And Loving it With Code Injection :)

  Scenario: Love A Painting From Painting Details
    Given I Am A Signed In User Of Id "2"
    And I Have Access To Backend
    And I Am On Specific Painting With Id Of "3"
    And I Saw How Many Loves On A Painting
    When I Love The Painting
    Then I Should Get a Response Code of "200"
    And I Should Get Valid JSON Response
    And The Loves On The Painting Should Be Increased By "1"

  Scenario: Love A Painting From Painting List
    Given I Am A Signed In User Of Id "2"
    And I Have Access To Backend
    And I Requested A Painting List
    And I Select One Of The Paintings
    And I Saw How Many Loves On A Painting
    When I Love A Painting From The List
    Then I Should Get a Response Code of "200"
    And I Should Get Valid JSON Response
    And The Loves On The Painting Should Be Increased By "1"

  Scenario: Love a Painting While NOT Signed In
    Given I Am A NOT Signed In User
    And I Have Access To Backend
    And I Am On Specific Painting With Id Of "3"
    When I Love The Painting
    Then I Should Get a Response Code of "403"
    And I Should Get A Response Explaining That I Should Login

  Scenario: Love a Painting While NOT Signed In
    Given I Am A Hacker Having A Bad User Id Of "99999"
    And I Have Access To Backend
    And I Am On Specific Painting With Id Of "3"
    When I Love The Painting
    Then I Should Get a Response Code of "403"
    And I Should Get A Response Explaining That I Should Login
