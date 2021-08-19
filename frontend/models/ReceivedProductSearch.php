<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\ReceivedProduct;

/**
 * ReceivedProductSearch represents the model behind the search form of `frontend\models\ReceivedProduct`.
 */
class ReceivedProductSearch extends ReceivedProduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'purchase_order_id', 'product_id', 'status'], 'integer'],
            [['received_date', 'maker', 'maker_time'], 'safe'],
            [['quantity', 'received', 'balance'], 'number'],
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
        $query = ReceivedProduct::find();

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
            'received_date' => $this->received_date,
            'purchase_order_id' => $this->purchase_order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'received' => $this->received,
            'balance' => $this->balance,
            'status' => $this->status,
            'maker_time' => $this->maker_time,
        ]);

        $query->andFilterWhere(['like', 'maker', $this->maker]);

        return $dataProvider;
    }
}
