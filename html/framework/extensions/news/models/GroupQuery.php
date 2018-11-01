<?php

namespace tina\news\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Group]].
 *
 * @see Group
 */
class GroupQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Group[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Group|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param int $hidden
     *
     * @return $this
     */
    public function hidden($hidden = Group::HIDDEN_NO)
    {
        return $this->andWhere([Group::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @param null $language
     *
     * @return $this
     */
    public function language($language = null)
    {
        if ($language === null) {
            $language = Yii::$app->language;
        }

        return $this->andWhere([Group::tableName() . '.[[language]]' => $language]);
    }
}
