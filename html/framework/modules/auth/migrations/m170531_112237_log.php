<?php

use yii\db\Migration;

class m170531_112237_log extends Migration
{
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%auth_log}}', [
            'id' => $this->primaryKey(),
            'authId' => $this->integer(11)->null()->defaultValue(null),
            'status' => $this->smallInteger(1)->null()->defaultValue(null),
            'ip' => $this->bigInteger(20)->null()->defaultValue(null),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('authId', '{{%auth_log}}', ['authId']);
        $this->addForeignKey(
            'auth_log_authId_auth_id',
            '{{%auth_log}}',
            ['authId'],
            '{{%auth}}',
            ['id'],
            'SET NULL',
            'RESTRICT'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('auth_log_authId_auth_id', '{{%auth_log}}');
        $this->dropTable('{{%auth_log}}');
    }
}
