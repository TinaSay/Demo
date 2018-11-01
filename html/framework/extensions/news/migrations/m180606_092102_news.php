<?php

use yii\db\Migration;

/**
 * Class m180606_092102_news_table
 */
class m180606_092102_news extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'date' => $this->dateTime()->null()->defaultValue(null),
            'announce' => $this->text()->null()->defaultValue(null),
            'text' => $this->text()->notNull(),
            'hidden' => $this->tinyInteger()->notNull()->defaultValue(0),
            'createdAt' => $this->dateTime()->null()->defaultValue(null),
            'updatedAt' => $this->dateTime()->null()->defaultValue(null),
        ], $options);

        $this->createIndex('date', '{{%news}}', 'date', false);
        $this->createIndex('hidden', '{{%news}}', 'hidden', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('hidden', '{{%news}}');
        $this->dropIndex('date', '{{%news}}');
        $this->dropTable('{{%news}}');
    }
}
