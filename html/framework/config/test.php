<?php
/**
 * Created by PhpStorm.
 * User: elfuvo
 * Date: 30.05.18
 * Time: 14:27
 */

$config = require(__DIR__ . DIRECTORY_SEPARATOR . 'frontend.php');
$config['components']['urlManager'] = require(__DIR__ . DIRECTORY_SEPARATOR . 'frontend' . DIRECTORY_SEPARATOR . 'urlManager.php');
$config['components']['user'] = [
    'class' => yii\web\User::class,
    'identityClass' => app\tests\User::class,
    'enableAutoLogin' => false,
];

return $config;
