<?php

namespace app\modules\directory\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Directory]].
 *
 * @see Directory
 */
class DirectoryQuery extends \yii\db\ActiveQuery
{
    /**
     * @inheritdoc
     * @return Directory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Directory|array|null
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
    public function hidden(int $hidden = Directory::HIDDEN_NO)
    {
        $this->andWhere([
            Directory::tableName() . '.[[hidden]]' => $hidden,
        ]);

        return $this;
    }

    /**
     * @param string|null $language
     *
     * @return $this
     */
    public function language(string $language = null)
    {
        if ($language === null) {
            $language = Yii::$app->language;
        }

        $this->andWhere([
            Directory::tableName() . '.[[language]]' => $language,
        ]);

        return $this;
    }
}
