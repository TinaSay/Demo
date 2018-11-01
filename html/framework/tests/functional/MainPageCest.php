<?php

namespace app\tests;

/**
 * Class MainPageCest
 *
 * @package app\tests
 */
class MainPageCest
{
    public function _before(FunctionalTester $I)
    {
        \Yii::setAlias('@webroot', '@root/web');
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function seePageTest(FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->seeResponseCodeIs(200);
    }
}
