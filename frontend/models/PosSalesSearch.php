<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PosSales;

/**
 * PosSalesSearch represents the model behind the search form of `frontend\models\PosSales`.
 */
class PosSalesSearch extends PosSales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'payment_method'], 'integer'],
            [['trn_dt', 'reference_number', 'customer_name', 'notes', 'maker_id', 'maker_time', 'status'], 'safe'],
            [['total_qty', 'tax', 'discount', 'sub_total_amount', 'total_amount', 'due_amount'], 'number'],
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
        $query = PosSales::find();

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
            'trn_dt' => $this->trn_dt,
            'total_qty' => $this->total_qty,
            'tax' => $this->tax,
            'discount' => $this->discount,
            'sub_total_amount' => $this->sub_total_amount,
            'total_amount' => $this->total_amount,
            'due_amount' => $this->due_amount,
            'payment_method' => $this->payment_method,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'reference_number', $this->reference_number])
            ->andFilterWhere(['like', 'customer_name', $this->customer_name])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'maker_id', $this->maker_id])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
