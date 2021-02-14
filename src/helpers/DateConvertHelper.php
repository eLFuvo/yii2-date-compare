<?php
/**
 * Created by PhpStorm
 * User: elfuvo
 * Date: 2021-02-14
 * Time: 19:42
 */

namespace elfuvo\dateCompare\helpers;

use DateTime;
use DateTimeZone;
use Yii;

/**
 * Class DateCompareHelper
 * @package elfuvo\dateCompare\helpers
 */
class DateConvertHelper
{
    /**
     * convert date from application time zone to database timezone (defaultTimeZone)
     *
     * @param string|null $value
     * @param string $format
     * @return string|null
     */
    public static function toDefaultTime(?string $value, string $format = 'Y-m-d H:i:s'): ?string
    {
        try {
            if ($value) {
                $dt = new DateTime($value, new DateTimeZone(Yii::$app->formatter->timeZone));
                $dt->setTimezone(new DateTimeZone(Yii::$app->formatter->defaultTimeZone));

                return $dt->format($format);
            }
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
        }
        return $value;
    }

    /**
     * @param string|null $value
     * @param string $format
     * @return string|null
     */
    public static function toApplicationTime(?string $value, string $format = 'Y-m-d H:i:s'): ?string
    {
        try {
            if ($value) {
                $dt = new DateTime($value, new DateTimeZone(Yii::$app->formatter->defaultTimeZone));
                $dt->setTimezone(new DateTimeZone(Yii::$app->formatter->timeZone));

                return $dt->format($format);
            }
        } catch (\Exception $e) {
            Yii::error($e->getMessage());
        }

        return $value;
    }
}
