<?php

namespace tina\news\models;

use krok\extend\behaviors\LanguageBehavior;
use krok\extend\behaviors\TimestampBehavior;
use krok\extend\interfaces\HiddenAttributeInterface;
use krok\extend\traits\HiddenAttributeTrait;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%news_group}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $language
 * @property integer $hidden
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property News news[]
 */
class Group extends \yii\db\ActiveRecord implements HiddenAttributeInterface
{
    use HiddenAttributeTrait;

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::class,
            ],
            'LanguageBehavior' => [
                'class' => LanguageBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news_group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['hidden'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['language'], 'string', 'max' => 8],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'language' => 'Язык',
            'hidden' => 'Скрыто',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::class, ['id' => 'newsId'])
            ->viaTable(NewsRelation::tableName(), ['groupId' => 'id']);
    }

    /**
     * @return array
     */
    public static function asDropDown()
    {
        return ArrayHelper::map(self::find()->language()->all(), 'id', 'title');
    }

    /**
     * @inheritdoc
     * @return GroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GroupQuery(get_called_class());
    }
}
