Feature: Create Artist
  This test will exploit the fallowing
  1. Create A Valid Artist
  2. Check The Content of the Artist With a Certain ID
  3. Create Artist From A Hacker Point of View
  4. Create Artist With Invalid Data Content
  5. I Have a Dangerous Code Insertion
  Since The Artist is Basically Copy Paste Painting
  I'm Gonna keep the tests to this

  Scenario: Create Artist From Valid JSON
    Given I Am A Signed In Administrator
    And I Have Access To Backend
    And I Have A Valid Artist Data
    When I Request Artist Create With The Data I Have
    Then I Should Get a Response Code of "200"
    And I Should Find The Newly Created Artist In The Artist List

  Scenario: Create Artist Missing Details
    Given I Am A Signed In Administrator
    And I Have Access To Backend
    And I Have Artist Data Without Artist Name
    When I Request Artist Create With The Data I Have
    Then I Should Get A Response Explaining The Error

  Scenario: Create Artist While Signed In But Not Administrator
    Given I Am Not A Signed In Administrator
    And I Have Access To Backend
    And I Have A Valid Artist Data
    When I Request Artist Create With The Data I Have
    Then I Should Get A Response Explaining The Error
    And I Should Get a Response Code of "403"

  Scenario: Create Artist With Invalid Social Links, Try Code Injection
    Given I Am A Signed In Administrator
    And I Have Access To Backend
    And I Have A Valid Artist Data
    When I Request Artist Create With The Data I Have
    Then I Should Find The Newly Created Artist In The Artist List
    And I Should Get A Response Explaining The Error

  Scenario: Create Artist With Invalid Social Links, Try Code Injection
    Given I Am NOT A Signed In Administrator
    And I Have Access To Backend
    And I Have A Valid Artist Data
    When I Request Artist Create With The Data I Have
    Then I Should Find The Newly Created Artist In The Artist List
    And I Should Get A Response Explaining The Error

  Scenario: Check Artist Data Match After Creation
    Given I Am A Signed In Administrator
    And I Have Access To Backend
    And I Have A Valid Artist Data
    When I Request Artist Create With The Data I Have
    Then I Should Find The Newly Created Artist In The Artist List
    And The Artist Data Found Matches The Artist Data

  Scenario: EXPOLIT, You don't have to login to create stuff,
  you just need a valid client id
    Given I Have Client Id Without Signing In
    And I Have Access To Backend
    And I Have A Valid Artist Data
    When I Request Artist Create With The Data I Have
    Then I Should Get A Response Explaining The Error
    And I Should Get a Response Code of "403"
