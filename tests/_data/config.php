<?php
/**
 * Created by PhpStorm
 * User: elfuvo
 * Date: 2021-02-14
 * Time: 19:43
 */

return [
    'id' => 'tests',
    'timeZone' => 'Europe/Moscow', // application time zone
    'defaultTimeZone' => 'UTC',// data base time zone
    'language' => 'ru',
    'basePath' => dirname(dirname(__DIR__)),
    'aliases' => [
        '@root' => dirname(dirname(dirname(__DIR__))),
        '@vendor' => '@root/vendor',
        '@bower' => '@vendor/bower-asset',
        '@runtime' => '@root/tests/_output/runtime',
    ],
    'container' => [
        'singletons' => [],
        'definitions' => [],
    ],
    'modules' => [],
    'components' => [],
];
