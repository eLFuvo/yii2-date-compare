[![Latest Stable Version](https://img.shields.io/github/v/release/elfuvo/yii2-compare-date.svg)](https://packagist.org/packages/elfuvo/yii2-compare-date)
[![Build](https://img.shields.io/github/workflow/status/elfuvo/yii2-compare-date/Build.svg)](https://github.com/elfuvo/yii2-compare-date)
[![Total Downloads](https://img.shields.io/github/downloads/elfuvo/yii2-compare-date/total.svg)](https://packagist.org/packages/elfuvo/yii2-compare-date)
[![License](https://img.shields.io/github/license/elfuvo/yii2-compare-date.svg)](https://github.com/elfuvo/yii2-compare-date/blob/master/LICENSE)

Requirements
------------

* PHP >=7.4

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist elfuvo/yii2-compare-date "~0.1.0"
```

or add

```
"elfuvo/yii2-compare-date": "~0.1.0"
```

to the "require" section of your `composer.json` file.

Configure
---------

In application configuration file set `defaultTimeZone` (DB time zone) and `timeZone` (application time zone)

```php
    [
        'timeZone' => 'Europe/Moscow', // application time zone
        'defaultTimeZone' => 'UTC',// data base time zone
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

You can define default date formatting for DateValueWidget in container definitions:

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
