<?php
/**
 * Created by PhpStorm
 * User: elfuvo
 * Date: 2021-02-14
 * Time: 20:04
 */

namespace app\tests;

use elfuvo\dateCompare\traits\DateCompareActiveQueryTrait;

/**
 * Class CustomQuery
 * @package _data
 */
class CustomQuery extends \yii\db\ActiveQuery
{
    use DateCompareActiveQueryTrait;
}
