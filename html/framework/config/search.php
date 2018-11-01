<?php
/**
 * Created by PhpStorm.
 * User: krok
 * Date: 14.07.18
 * Time: 10:59
 */

return [
    /**
     * Content
     */
    [
        'dataProvider' => function () {
            return \krok\content\models\Content::find()->select([
                \krok\content\models\Content::tableName() . '.[[id]]',
                \krok\content\models\Content::tableName() . '.[[alias]]',
                \krok\content\models\Content::tableName() . '.[[title]]',
                \krok\content\models\Content::tableName() . '.[[text]]',
                \krok\content\models\Content::tableName() . '.[[language]]',
            ])->where([
                \krok\content\models\Content::tableName() . '.[[hidden]]' => \krok\content\models\Content::HIDDEN_NO,
            ]);
        },
        'fields' => [
            'module' => function () {
                return 'Content';
            },
            'record_id' => function ($model) {
                return $model['id'];
            },
            'language' => function ($model) {
                return $model['language'];
            },
            'title' => function ($model) {
                return $model['title'];
            },
            'description' => function ($model) {
                return implode(' ', [
                    $model['title'],
                    $model['text'],
                ]);
            },
            'data' => function ($model) {
                return implode(' ', [
                    $model['title'],
                    $model['text'],
                ]);
            },
            'url' => function ($model) {
                return Yii::$app->getUrlManager('frontend')->createUrl([
                    '/content/default/index',
                    'alias' => $model['alias'],
                ]);
            },
            'url_backend' => function ($model) {
                return Yii::$app->getUrlManager('backend')->createUrl([
                    '/content/default/view',
                    'id' => $model['id'],
                ]);
            },
        ],
    ],
];
