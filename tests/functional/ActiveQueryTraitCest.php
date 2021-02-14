<?php

use app\tests\CustomQuery;

/**
 * Class ActiveQueryTraitCest
 */
class ActiveQueryTraitCest
{
    public function _before(FunctionalTester $I)
    {
        new \yii\console\Application(require(dirname(__DIR__) . '/_data/config.php'));
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        // russian date format
        $date = '31.12.2020 12:11:01'; // GMT+3 date

        $query = (new CustomQuery('Custom'))
            ->from('{{%custom}}')
            ->andWhere('1=1');

        $queryAnd = (clone $query)->andCompareDate('>', '{{%custom}}.[[createdAt]]', $date);

        $I->assertEquals([
            'and',
            '1=1',
            [
                '>',
                '{{%custom}}.[[createdAt]]',
                '2020-12-31'
            ]
        ],
            $queryAnd->where
        );

        $queryAnd = (clone $query)->andCompareTime('>=', '{{%custom}}.[[createdAt]]', $date);
        $I->assertEquals([
            'and',
            '1=1',
            [
                '>=',
                '{{%custom}}.[[createdAt]]',
                '2020-12-31 09:11:01'
            ]
        ],
            $queryAnd->where
        );

        $queryOr = (clone $query)->orCompareDate('<', '{{%custom}}.[[createdAt]]', $date);

        $I->assertEquals([
            'or',
            '1=1',
            [
                '<',
                '{{%custom}}.[[createdAt]]',
                '2020-12-31'
            ]
        ],
            $queryOr->where
        );

        $queryOr = (clone $query)->orCompareTime('<=', '{{%custom}}.[[createdAt]]', $date);
        $I->assertEquals([
            'or',
            '1=1',
            [
                '<=',
                '{{%custom}}.[[createdAt]]',
                '2020-12-31 09:11:01'
            ]
        ],
            $queryOr->where
        );
    }
}
