<?php

use yii\db\Migration;

/**
 * Class m180714_111321_directory
 */
class m180714_111321_directory extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%directory}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'hidden' => $this->smallInteger(1)->notNull()->defaultValue(0),
            'language' => $this->string(8)->notNull(),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%directory}}');
    }
}
