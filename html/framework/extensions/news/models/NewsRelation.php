<?php

namespace tina\news\models;

/**
 * This is the model class for table "{{%news_relation}}".
 *
 * @property integer $id
 * @property integer $newsId
 * @property integer $groupId
 *
 * @property Group $group
 * @property News $news
 */
class NewsRelation extends \yii\db\ActiveRecord
{
    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_relation}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newsId', 'groupId'], 'required'],
            [['newsId', 'groupId'], 'integer'],
            [
                ['groupId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Group::className(),
                'targetAttribute' => ['groupId' => 'id'],
            ],
            [
                ['newsId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => News::className(),
                'targetAttribute' => ['newsId' => 'id'],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'newsId' => 'News ID',
            'groupId' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'groupId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'newsId']);
    }

    /**
     * @inheritdoc
     * @return NewsRelationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsRelationQuery(get_called_class());
    }
}
