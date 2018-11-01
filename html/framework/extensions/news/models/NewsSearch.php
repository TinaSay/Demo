<?php

namespace tina\news\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * NewsSearch represents the model behind the search form about `tina\news\models\News`.
 */
class NewsSearch extends News
{
    /**
     * @var int
     */
    public $groupId;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'hidden', 'groupId'], 'integer'],
            [['title'], 'string'],
            [['date', 'createdAt', 'updatedAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find()->joinWith([
            'groupRelation',
        ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            News::tableName() . '.[[id]]' => $this->id,
            News::tableName() . '.[[hidden]]' => $this->hidden,
            Group::tableName() . '.[[id]]' => $this->groupId,
        ]);

        $query
            ->andFilterWhere(['like', News::tableName() . '.[[title]]', $this->title])
            ->andFilterWhere(['like', News::tableName() . '.[[date]]', $this->date])
            ->andFilterWhere(['like', News::tableName() . '.[[createdAt]]', $this->createdAt])
            ->andFilterWhere(['like', News::tableName() . '.[[updatedAt]]', $this->updatedAt]);

        return $dataProvider;
    }
}
