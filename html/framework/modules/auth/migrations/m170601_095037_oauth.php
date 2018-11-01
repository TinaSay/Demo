<?php

use yii\db\Migration;

class m170601_095037_oauth extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%auth_oauth}}', [
            'id' => $this->primaryKey(),
            'authId' => $this->integer(11)->notNull(),
            'source' => $this->string(256)->notNull(),
            'sourceId' => $this->string(256)->notNull(),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('authId', '{{%auth_oauth}}', ['authId']);
        $this->addForeignKey(
            'auth_oauth_authId_auth_id',
            '{{%auth_oauth}}',
            ['authId'],
            '{{%auth}}',
            ['id'],
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('auth_oauth_authId_auth_id', '{{%auth_oauth}}');
        $this->dropTable('{{%auth_oauth}}');
    }
}
