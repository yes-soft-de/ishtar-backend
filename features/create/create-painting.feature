Feature: Create Painting
  This test will exploit the fallowing
  1. Create A Valid Painting
  2. Check The Content of the Painting With a Certain ID
  3. Create Painting From A Hacker Point of View
  4. Create Painting With Invalid Data Content
  5. I Have a Dangerous Code Insertion
  Since The Painting is Basically Copy Paste Painting
  I'm Gonna keep the tests to this

  Scenario: Create Painting From Valid JSON
    Given I Am A Signed In Administrator
    And I Have Access To Backend
    And I Have A Valid Painting Data
    When I Request Painting Create With The Data I Have
    Then I Should Find The Newly Created Painting In The Painting List
    And The Painting Data Found Matches The Painting Data
    And I Should Get a Response Code of "200"

  Scenario: Create Painting Missing Details
    Given I Am A Signed In Administrator
    And I Have Access To Backend
    And I Have Painting Data Without Painting Name
    When I Request Painting Create With The Data I Have
    Then I Should Get A Response Explaining The Error

  Scenario: Create Painting While Signed In But Not Administrator
    Given I Am Not A Signed In Administrator
    And I Have Access To Backend
    And I Have A Valid Painting Data
    When I Request Painting Create With The Data I Have
    Then I Should Get A Response Explaining The Error
    And I Should Get a Response Code of "403"

  Scenario: Create Painting With Invalid Social Links
    Given I Am A Signed In Administrator
    And I Have Access To Backend
    And I Have A NOT Valid Painting Data
    When I Request Painting Create With The Data I Have
    Then I Should Get A Response Explaining The Error

  Scenario: Create Painting With Invalid Social Links, Try Code Injection
    Given I Am NOT A Signed In Administrator
    And I Have Access To Backend
    And I Have A Valid Painting Data
    When I Request Painting Create With The Data I Have
    Then I Should Find The Newly Created Painting In The Painting List
    And I Should Get A Response Explaining The Error


