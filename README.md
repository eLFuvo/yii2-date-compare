[![Latest Stable Version](https://img.shields.io/github/v/release/elfuvo/yii2-date-compare.svg)](https://packagist.org/packages/elfuvo/yii2-date-compare)
[![Build](https://img.shields.io/github/workflow/status/elfuvo/yii2-date-compare/Build.svg)](https://github.com/elfuvo/yii2-date-compare)
[![Total Downloads](https://img.shields.io/github/downloads/elfuvo/yii2-date-compare/total.svg)](https://packagist.org/packages/elfuvo/yii2-date-compare)
[![License](https://img.shields.io/github/license/elfuvo/yii2-date-compare.svg)](https://github.com/elfuvo/yii2-date-compare/blob/master/LICENSE)

Requirements
------------

* PHP >=7.4

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist elfuvo/yii2-date-compare "~0.1.0"
```

or add

```
"elfuvo/yii2-date-compare": "~0.1.0"
```

to the "require" section of your `composer.json` file.

Configure
---------

In application configuration file set `defaultTimeZone` (DB time zone) and `timeZone` (application time zone) for
formatter

```php
    [
        'components' => [
            'formatter' => [
                'class' => \yii\i18n\Formatter::class,
                'defaultTimeZone' => 'UTC', // database timezone
                'timeZone' => 'Europe/Moscow', // application time zone
            ],
        ],
    ];
```

Usage
---------

Add `DateCompareActiveQueryTrait` to your ActiveQuery class. Then use `where` functions on selection.

```php
Custom::find()->andCompareDate('>', Custom::tableName().'.[[createdAt]]', $model->dateFrom);

Custom::find()->orCompareTime('<=', Custom::tableName().'.[[createdAt]]', $model->dateTimeFrom);

Custom::find()->orWhere([
    'AND',
    ['>=', Custom::tableName().'.[[createdAt]]', DateConvertHelper::toDefaultTime($model->dateTimeFrom)],
    ['<=', Custom::tableName().'.[[createdAt]]', DateConvertHelper::toDefaultTime($model->dateTimeTo)],
]);


```

In filter view you must use yii formatter:

```php
$form->field($model, 'dateFrom')->textInput(['value' => Yii::$app->formatter->asDate($model->dateFrom, 'dd.MM.yyyy')]);
```

You can use `DateValueWidget` for date formatting:

```php
$form->field($model, 'dateFrom')->widget([
    'class'=> DateValueWidget::class,
    'format' =>'dd.MM.yyyy HH:mm'
]);
```

You can define default date formatting for `DateValueWidget` in container definitions:

```php
[
    'containers' => [
        'definitions' =>[
            \elfuvo\dateCompare\widgets\DateValueWidget::class =>[
                'class' => \elfuvo\dateCompare\widgets\DateValueWidget::class,
                'format' => 'dd/MM/yyyy',
            ],
        ],  
    ]
];
```
