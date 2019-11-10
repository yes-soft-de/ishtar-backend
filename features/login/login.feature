Feature: Our Login System

  Scenario: Register A New User
    Given I Have Access To Backend
    And My Email Is "Mohammad@Gmail.com"
    And My Password Is "M0h@mm@d"
    And I Am NOT A Registered User
    When I Request Register New User
    Then I Should Get A Response Explaining Success

  Scenario: Get Login Token When Registered
    Given I Have Access To Backend
    And My Email Is "Mohammad@Gmail.com"
    And My Password Is "M0h@mm@d"
    When I Request Login
    Then I Should Get A Valid Json Response
    And I Should Get A Login Token In The JSON

  Scenario: Register Tow Duplicate Accounts With the Same Email
    Given I Have Access To Backend
    And I Am A Registered User
    When I Request Register With The Same Email Address
    Then I Should Get A Response Explaining The Registration Error

  Scenario: Register User With Bad Password
    Given I Have Access To Backend
    And My Email Is "Mohammad2@Gmail.com"
    And My Password Is "M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    M0h@mm@d    "
    And I Am NOT A Registered User
    When I Request Register New User
    Then I Should Get A Response Explaining The Registration Error

  Scenario: Register User With Bad Email
    Given I Have Access To Backend
    And My Email Is "M0h@mm@d"
    And My Password Is "M0h@mm@d"
    And I Am NOT A Registered User
    When I Request Register New User
    Then I Should Get A Response Explaining The Registration Error

  Scenario: Login With Unregistered Email
    Given I Have Access To Backend
    And My Email Is "M0hammad@Gmail.com"
    And My Password Is "M0h@mm@d"
    And I Am NOT A Registered User
    When I Request Login
    Then I Should Get A Valid Json Response
    Then I Should Get A Response That Contains "Bad credentials."
