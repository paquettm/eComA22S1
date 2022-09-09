Feature: new food
  In order to add foods to the database
  As a user
  I need to enter the food item and click the submit button

  Scenario: try adding "fish"
    Given I am on "Main/foods"
    When I input "fish" in "new_food"
    And I click the food submit
    Then I see "fish"

  Scenario: try adding "chicken"
    Given I am on "Main/foods"
    When I input "chicken" in "new_food"
    And I click the food submit
    Then I see "chicken"

  Scenario: try adding "beef"
    Given I am on "Main/foods"
    When I input "beef" in "new_food"
    And I click the food submit
    Then I see "beef"
