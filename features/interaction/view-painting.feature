Feature: View Interaction
  Loving The Painting From a List, Loving it From Details And Loving it With Code Injection :)

  Scenario: View A Painting From Painting Details
    Given I Am A Signed In User Of Id "2"
    And I Have Access To Backend
    And I Am On Specific Painting With Id Of "3"
    And I Saw How Many Views On A Painting
    When I View The Painting
    Then I Should Get a Response Code of "200"
    And I Should Get Valid JSON Response
    And The Views On The Painting Should Be Increased By "1"

  Scenario: View A Painting From Painting List
    Given I Am A Signed In User Of Id "2"
    And I Have Access To Backend
    And I Requested A Painting List
    And I Select One Of The Paintings
    And I Saw How Many Views On A Painting
    When I View A Painting From The List
    Then I Should Get a Response Code of "200"
    And I Should Get Valid JSON Response
    And The Views On The Painting Should Be Increased By "1"

  Scenario: View a Painting While NOT Signed In
    Given I Am A NOT Signed In User
    And I Have Access To Backend
    And I Am On Specific Painting With Id Of "3"
    When I View The Painting
    Then I Should Get a Response Code of "403"
    And I Should Get A Response Explaining That I Should Login

  Scenario: View a Painting While NOT Signed In
    Given I Am A Hacker Having A Bad User Id Of "99999"
    And I Have Access To Backend
    And I Am On Specific Painting With Id Of "3"
    When I View The Painting
    Then I Should Get a Response Code of "403"
    And I Should Get A Response Explaining That I Should Login
