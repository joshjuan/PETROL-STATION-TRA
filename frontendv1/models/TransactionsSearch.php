<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Transactions;

/**
 * TransactionsSearch represents the model behind the search form of `backend\models\Transactions`.
 */
class TransactionsSearch extends Transactions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'sale_id', 'payment_method', 'physical_code', 'created_by'], 'integer'],
            [['ref_no', 'transaction_date', 'created_at', 'updated_at'], 'safe'],
            [['amount_in', 'amount_out'], 'number'],
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
        $query = Transactions::find();

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
            'customer_id' => $this->customer_id,
            'sale_id' => $this->sale_id,
            'transaction_date' => $this->transaction_date,
            'amount_in' => $this->amount_in,
            'amount_out' => $this->amount_out,
            'payment_method' => $this->payment_method,
            'physical_code' => $this->physical_code,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'ref_no', $this->ref_no]);

        return $dataProvider;
    }
}
