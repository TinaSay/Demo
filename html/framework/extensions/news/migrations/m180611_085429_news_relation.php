<?php

use yii\db\Migration;

/**
 * Class m180611_085429_newsRelation
 */
class m180611_085429_news_relation extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = ($this->db->getDriverName() === 'mysql') ? 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci' : null;

        $this->createTable('{{%news_relation}}', [
            'id' => $this->primaryKey(),
            'newsId' => $this->integer(8),
            'groupId' => $this->integer(8),
        ], $options);

        $this->addForeignKey(
            'news_relation_newsId_news_id',
            '{{%news_relation}}',
            'newsId',
            '{{%news}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

        $this->addForeignKey(
            'news_relation_groupId_news_group_id',
            '{{%news_relation}}',
            'groupId',
            '{{%news_group}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('news_relation_groupId_news_group_id', '{{%news_relation}}');
        $this->dropForeignKey('news_relation_newsId_news_id', '{{%news_relation}}');
        $this->dropTable('{{%news_relation}}');
    }
}
