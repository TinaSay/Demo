<?php

namespace app\modules\auth\models;

use krok\extend\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%auth_oauth}}".
 *
 * @property integer $id
 * @property integer $authId
 * @property string $source
 * @property string $sourceId
 * @property string $createdAt
 * @property string $updatedAt
 *
 * @property Auth $auth
 */
class OAuth extends \yii\db\ActiveRecord
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
     * @return array
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auth_oauth}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['authId', 'source', 'sourceId'], 'required'],
            [['authId'], 'integer'],
            [['createdAt', 'updatedAt'], 'safe'],
            [['source', 'sourceId'], 'string', 'max' => 256],
            [
                ['authId'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Auth::className(),
                'targetAttribute' => ['authId' => 'id'],
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
            'authId' => 'Пользователь',
            'source' => 'Социальная сеть',
            'sourceId' => 'Пользователь в социальной сети',
            'createdAt' => 'Создано',
            'updatedAt' => 'Обновлено',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuth()
    {
        return $this->hasOne(Auth::className(), ['id' => 'authId']);
    }
}
