<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\EndOfPeriod;

/**
 * EndOfPeriodSearch represents the model behind the search form of `frontend\models\EndOfPeriod`.
 */
class EndOfPeriodSearch extends EndOfPeriod
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['previous_working_day', 'current_working_day', 'next_working_day'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = EndOfPeriod::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'previous_working_day' => $this->previous_working_day,
            'current_working_day' => $this->current_working_day,
            'next_working_day' => $this->next_working_day,
        ]);

        return $dataProvider;
    }
}
