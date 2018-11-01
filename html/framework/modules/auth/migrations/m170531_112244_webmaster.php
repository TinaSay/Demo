<?php

use yii\db\Expression;
use yii\db\Migration;

class m170531_112244_webmaster extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%auth}}', [
            'login' => 'webmaster',
            'password' => Yii::$app->getSecurity()->generatePasswordHash('webmaster'),
            'authKey' => Yii::$app->getSecurity()->generateRandomString(128),
            'accessToken' => Yii::$app->getSecurity()->generateRandomString(128),
            'email' => 'webmaster@dev-vps.ru',
            'blocked' => 0,
            'createdAt' => new Expression('NOW()'),
            'updatedAt' => new Expression('NOW()'),
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%auth}}', ['login' => 'webmaster']);
    }
}
