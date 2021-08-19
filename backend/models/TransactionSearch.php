<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Transaction;

/**
 * TransactionSearch represents the model behind the search form of `backend\models\Transaction`.
 */
class TransactionSearch extends Transaction
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'transaction_id', 'pump_number', 'nozzel_number', 'status'], 'integer'],
            [['trn_date', 'trn_time', 'product_name', 'qr_code'], 'safe'],
            [['volume', 'price', 'amount', 'tax', 'total_amount'], 'number'],
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
        $query = Transaction::find();

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
            'trn_date' => $this->trn_date,
            'trn_time' => $this->trn_time,
            'transaction_id' => $this->transaction_id,
            'pump_number' => $this->pump_number,
            'nozzel_number' => $this->nozzel_number,
            'volume' => $this->volume,
            'price' => $this->price,
            'amount' => $this->amount,
            'tax' => $this->tax,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'qr_code', $this->qr_code]);

        return $dataProvider;
    }
}
