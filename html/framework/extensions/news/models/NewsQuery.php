<?php

namespace tina\news\models;

use yii\db\Expression;

/**
 * This is the ActiveQuery class for [[News]].
 *
 * @see News
 */
class NewsQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return News[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return News|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return $this
     */
    public function list()
    {
        return $this->joinWith([
            'groupRelation' => function (GroupQuery $query) {
                $query->hidden();
            },
        ]);
    }

    /**
     * @return $this
     */
    public function order()
    {
        return $this->orderBy([
            News::tableName() . '.[[date]]' => SORT_DESC,
            News::tableName() . '.[[id]]' => SORT_DESC,
        ]);
    }

    /**
     * @param int $hidden
     *
     * @return $this
     */
    public function hidden($hidden = News::HIDDEN_NO)
    {
        return $this->andWhere([News::tableName() . '.[[hidden]]' => $hidden]);
    }

    /**
     * @return $this
     */
    public function postponed()
    {
        return $this->andwhere(['<', News::tableName() . '.[[date]]', new Expression('NOW()')]);
    }

    /**
     * @param $id
     *
     * @return array|null|News
     */
    public function byId($id)
    {
        return $this->andwhere([News::tableName() . '.[[id]]' => $id])->joinWith([
            'groupRelation' => function (GroupQuery $query) {
                $query->hidden();
            },
        ])->hidden()->one();
    }
}
