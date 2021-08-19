<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Company;

/**
 * CompanySearch represents the model behind the search form of `backend\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tin', 'company_id_type','status','reg_status'], 'integer'],
            [['name', 'vrn', 'serial_number', 'uin', 'tax_office', 'address', 'email', 'business_licence', 'contact_person','company_username','certificate_serial','passwrod', 'create_by', 'created_at', 'updated_at'], 'safe'],
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
        $query = Company::find();

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
            'tin' => $this->tin,
            'company_id_type' => $this->company_id_type,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'vrn', $this->vrn])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'uin', $this->uin])
            ->andFilterWhere(['like', 'tax_office', $this->tax_office])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'business_licence', $this->business_licence])
            ->andFilterWhere(['like', 'company_username', $this->company_username])
               ->andFilterWhere(['like', 'certificate_serial', $this->certificate_serial])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'create_by', $this->create_by]);

        return $dataProvider;
    }

    public function searchActive($params)
    {
        $query = Company::find();

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
            'tin' => $this->tin,
            'company_id_type' => $this->company_id_type,
            'status' => Company::ACTIVE,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'vrn', $this->vrn])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'uin', $this->uin])
            ->andFilterWhere(['like', 'tax_office', $this->tax_office])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'business_licence', $this->business_licence])
            ->andFilterWhere(['like', 'company_username', $this->company_username])
               ->andFilterWhere(['like', 'certificate_serial', $this->certificate_serial])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'create_by', $this->create_by]);

        return $dataProvider;
    }

    public function searchInActive($params)
    {
        $query = Company::find();

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
            'tin' => $this->tin,
            'company_id_type' => $this->company_id_type,
            'status' => 2,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'vrn', $this->vrn])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'uin', $this->uin])
            ->andFilterWhere(['like', 'tax_office', $this->tax_office])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'business_licence', $this->business_licence])
            ->andFilterWhere(['like', 'company_username', $this->company_username])
               ->andFilterWhere(['like', 'certificate_serial', $this->certificate_serial])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'create_by', $this->create_by]);

        return $dataProvider;
    }

    public function searchTraRegisteredCompany($params)
    {
        $query = Company::find();

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
            'tin' => $this->tin,
            'reg_status' => Company::ALREADY_REGISTERED,
            'company_id_type' => $this->company_id_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'vrn', $this->vrn])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'uin', $this->uin])
            ->andFilterWhere(['like', 'tax_office', $this->tax_office])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'business_licence', $this->business_licence])
            ->andFilterWhere(['like', 'company_username', $this->company_username])
               ->andFilterWhere(['like', 'certificate_serial', $this->certificate_serial])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'create_by', $this->create_by]);

        return $dataProvider;
    }

    public function searchTraNotRegisteredCompany($params)
    {
        $query = Company::find();

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
            'tin' => $this->tin,
            'reg_status' => Company::NOT_REGISTERED,
            'company_id_type' => $this->company_id_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'vrn', $this->vrn])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number])
            ->andFilterWhere(['like', 'uin', $this->uin])
            ->andFilterWhere(['like', 'tax_office', $this->tax_office])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'business_licence', $this->business_licence])
            ->andFilterWhere(['like', 'company_username', $this->company_username])
               ->andFilterWhere(['like', 'certificate_serial', $this->certificate_serial])
            ->andFilterWhere(['like', 'contact_person', $this->contact_person])
            ->andFilterWhere(['like', 'create_by', $this->create_by]);

        return $dataProvider;
    }
}
