<?php
/**
 * Created by PhpStorm
 * User: elfuvo
 * Date: 2021-02-14
 * Time: 20:33
 */

namespace elfuvo\dateCompare\widgets;

use Yii;
use yii\widgets\InputWidget;

/**
 * Class DateValueWidget
 * @package elfuvo\dateCompare\widgets
 */
class DateValueWidget extends InputWidget
{
    /**
     * @var string
     */
    public string $format = 'dd.MM.yyyy';

    /**
     * @return string|void
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        if (isset($this->options['value'])) {
            $value = $this->options['value'];
        } else {
            $value = $this->model->getAttributes([$this->attribute]);
            $value = array_shift($value);
        }
        $this->options['value'] = Yii::$app->formatter->asDatetime($value, $this->format);

        return parent::run();
    }
}
