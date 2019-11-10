Feature: Using the Protected Links for Interactions

  Scenario: Create A Love
    Given I Have Access To Backend
    And I Am A Registered User
    And I Am A Logged In User
    And I Am On A Painting Page Of Id "15"
    And The Painting Has A Certain Loves
    When I Perform A Love
    Then The Total Painting Loves Is Increased By "1"
