Feature: google
  In order to find things on the Web
  As a user
  I need to input search terms and click search to see results

  Scenario: try googling "dog"
    Given I am on "https://google.ca"
    When I input "dog"
    And I click Search
    Then I see "dog"

  Scenario: try googling "fish"
    Given I am on "https://google.ca"
    When I input "fish"
    And I click Search
    Then I see "fish"

    