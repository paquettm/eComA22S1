Feature: deleteFood
  In order to delete food from the list
  As a user
  I need to click on the delete link next to the food item to delete

  Scenario: try to delete "fish"
    Given I am on "Main/foods"
    When I click "delete" after "fish"
    Then I can not see "fish"

  Scenario: try to delete "dog"
    Given I am on "Main/foods"
    When I click "delete" after "dog"
    Then I can not see "dog"

  Scenario: try to delete "beef"
    Given I am on "Main/foods"
    When I click "delete" after "beef"
    Then I can not see "beef"

