<?php

declare(strict_types=1);

namespace Tests\Support;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * Define custom actions here
     */

    /**
     * @Given I am on :arg1
     */
     public function iAmOn($arg1)
     {
         $this->amOnPage($arg1);
     }

    /**
     * @When I input :arg1
     */
     public function iInput($arg1)
     {
         $this->fillField('q',$arg1);
     }

    /**
     * @When I click Search
     */
     public function iClickSearch()
     {
         $this->click('Google Search');
     }

    /**
     * @Then I see :arg1
     */
     public function iSee($arg1)
     {
         $this->see($arg1);
     }
}
