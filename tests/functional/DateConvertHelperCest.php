<?php

use elfuvo\dateCompare\helpers\DateConvertHelper;

/**
 * Class DateConvertHelperCest
 */
class DateConvertHelperCest
{
    public function _before(FunctionalTester $I)
    {
        new \yii\console\Application(require(dirname(__DIR__) . '/_data/config.php'));
        Yii::$app->setTimeZone('Europe/Moscow');
    }

    // tests
    public function dateConvertTest(FunctionalTester $I)
    {
        // russian date format
        $date = '31.12.2020 12:11:01'; // GMT+3 date
        $dbDate = DateConvertHelper::toDefaultTime($date); // UTC

        $I->assertEquals('2020-12-31 09:11:01', $dbDate);
        $I->assertEquals('2020-12-31 12:11:01', DateConvertHelper::toApplicationTime($dbDate));
    }
}
