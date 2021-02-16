<?php
/**
 * Created by PhpStorm
 * User: elfuvo
 * Date: 2021-02-14
 * Time: 19:42
 */

namespace elfuvo\dateCompare\traits;

use yii\db\ActiveQuery;
use elfuvo\dateCompare\helpers\DateConvertHelper;

/**
 * Trait DateCompareActiveQueryTrait
 * @package elfuvo\dateCompare\traits
 *
 * @mixin ActiveQuery
 */
trait DateCompareActiveQueryTrait
{
    /**
     * compare date by date
     *
     * @param string $operator - compare operator: <, <=, =, =>, >
     * @param string $field - table field {{%foo}}.[[bar]]
     * @param string|null $date - date for comparing - 2021-02-14 (GMT +3)
     * @param string $format - date format for comparing in DB
     * @return ActiveQuery|DateCompareActiveQueryTrait
     */
    public function andCompareDate(
        string $operator,
        string $field,
        ?string $date,
        string $format = 'Y-m-d'
    ): ActiveQuery {
        if ($date && $date = DateConvertHelper::toDefaultTime($date, $format)) {
            return $this->andWhere([
                $operator,
                $field,
                $date
            ]);
        }

        return $this;
    }

    /**
     * @param string $operator - compare operator: <, <=, =, =>, >
     * @param string $field - table field {{%foo}}.[[bar]]
     * @param string|null $date - date for comparing - 2021-02-14 (GMT +3)
     * @param string $format - date format for comparing in DB
     * @return ActiveQuery|DateCompareActiveQueryTrait
     */
    public function orCompareDate(
        string $operator,
        string $field,
        ?string $date,
        string $format = 'Y-m-d'
    ): ActiveQuery {
        if ($date && $date = DateConvertHelper::toDefaultTime($date, $format)) {
            return $this->orWhere([
                $operator,
                $field,
                $date
            ]);
        }

        return $this;
    }

    /**
     * compare date by date & time
     *
     * @param string $operator - compare operator: <, <=, =, =>, >
     * @param string $field - table field {{%foo}}.[[bar]]
     * @param string|null $date - date for comparing - 2021-02-14 (GMT +3)
     * @return ActiveQuery|DateCompareActiveQueryTrait
     */
    public function andCompareTime(
        string $operator,
        string $field,
        ?string $date
    ): ActiveQuery {
        return $this->andCompareDate($operator, $field, $date, 'Y-m-d H:i:s');
    }

    /**
     * compare date by date & time
     *
     * @param string $operator - compare operator: <, <=, =, =>, >
     * @param string $field - table field {{%foo}}.[[bar]]
     * @param string|null $date - date for comparing - 2021-02-14 (GMT +3)
     * @return ActiveQuery|DateCompareActiveQueryTrait
     */
    public function orCompareTime(
        string $operator,
        string $field,
        ?string $date
    ): ActiveQuery {
        return $this->orCompareDate($operator, $field, $date, 'Y-m-d H:i:s');
    }
}
