Feature: google
  In order to search for things on Google
  As a user
  I need to be able to write search terms and get results back

  Scenario: try googling "fish"
    Given I am on "https://google.ca"
    When I input "fish"
    And I click Search
    Then I see "fish"

  Scenario: try googling "dog"
    Given I am on "https://google.ca"
    When I input "dog"
    And I click Search
    Then I see "dog"

  Scenario: try googling "whale"
    Given I am on "https://google.ca"
    When I input "whale"
    And I click Search
    Then I see "whale"
