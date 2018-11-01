<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 07.04.18
 * Time: 10:40
 */

return [
    'class' => \krok\language\UrlManager::class,
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'normalizer' => [
        'class' => \yii\web\UrlNormalizer::class,
    ],
    'rules' => require('rules.php'),
    'baseUrl' => '/cp',
    'hostInfo' => getenv('YII_HOST_INFO'),
];
