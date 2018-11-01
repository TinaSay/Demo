<?php

use yii\db\Migration;

/**
 * Class m180611_084944_newsGroup
 */
class m180611_084944_news_group extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%news_group}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'language' => $this->string(8)->null()->defaultValue(null),
            'hidden' => $this->tinyInteger()->notNull()->defaultValue(0),
            'createdAt' => $this->dateTime()->notNull()->defaultValue(null),
            'updatedAt' => $this->dateTime()->notNull()->defaultValue(null),
        ], $options);

        $this->createIndex('language', '{{%news_group}}', 'language', false);
        $this->createIndex('hidden', '{{%news_group}}', 'hidden', false);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('hidden', '{{%news_group}}');
        $this->dropIndex('language', '{{%news_group}}');
        $this->dropTable('{{%news_group}}');
    }
}
