<?php

namespace app\modules\auth\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Request;

/**
 * LogSearch represents the model behind the search form about `app\modules\auth\models\Log`.
 */
class LogSearch extends Log
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * LogSearch constructor.
     *
     * @param Request $request
     * @param array $config
     */
    public function __construct(Request $request, array $config = [])
    {
        $this->request = $request;
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'authId', 'status'], 'integer'],
            [['ip', 'createdAt'], 'safe'],
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
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = Log::find()->joinWith('auth')->orderBy(['createdAt' => SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($this->request->getQueryParams());

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'authId' => $this->authId,
            'status' => $this->status,
            'ip' => $this->ip ? ip2long($this->ip) : null,
        ])->andFilterWhere(['like', 'createdAt', $this->createdAt]);

        return $dataProvider;
    }
}
