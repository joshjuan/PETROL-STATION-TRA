<?php

namespace frontend\models;

use frontend\models\RequestQuotation;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RequestQuotationSearch represents the model behind the search form of `frontend\models\RequestQuotation`.
 */
class RequestQuotationSearch extends RequestQuotation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'supplier_id', 'status'], 'integer'],
            [['reference_number', 'order_date', 'maker', 'maker_time'], 'safe'],
            [['sub_total_amount', 'tax', 'total_amount'], 'number'],
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
        $query = RequestQuotation::find();

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
            'order_date' => $this->order_date,
            'supplier_id' => $this->supplier_id,
            'sub_total_amount' => $this->sub_total_amount,
            'tax' => $this->tax,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'reference_number', $this->reference_number])
            ->andFilterWhere(['like', 'maker', $this->maker]);

        return $dataProvider;
    }

    public function searchRequests($params)
    {
        $query = RequestQuotation::find();
      //  $query->where(['status' => self::Draft]);

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
            'order_date' => $this->order_date,
            'supplier_id' => $this->supplier_id,
            'sub_total_amount' => $this->sub_total_amount,
            'tax' => $this->tax,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'reference_number', $this->reference_number])
            ->andFilterWhere(['like', 'maker', $this->maker]);

        return $dataProvider;
    }

    public function searchPurchaseOrders($params)
    {
        $query = RequestQuotation::find();
        $query->where(['status' => self::Purchase_Order]);

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
            'order_date' => $this->order_date,
            'supplier_id' => $this->supplier_id,
            'sub_total_amount' => $this->sub_total_amount,
            'tax' => $this->tax,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'reference_number', $this->reference_number])
            ->andFilterWhere(['like', 'maker', $this->maker]);

        return $dataProvider;
    }
}
