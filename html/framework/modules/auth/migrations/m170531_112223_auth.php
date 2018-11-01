<?php

use yii\db\Migration;

class m170531_112223_auth extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%auth}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string(32)->notNull(),
            'password' => $this->string(512)->notNull(),
            'authKey' => $this->string(128)->null()->defaultValue(null),
            'accessToken' => $this->string(128)->null()->defaultValue(null),
            'email' => $this->string(64)->null()->defaultValue(null),
            'blocked' => $this->smallInteger(1)->notNull()->defaultValue(1),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('login', '{{%auth}}', ['login'], true);
        $this->createIndex('blocked', '{{%auth}}', ['blocked']);
    }

    public function safeDown()
    {
        $this->dropTable('{{%auth}}');
    }
}
