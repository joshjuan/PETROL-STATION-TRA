<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string|null $phone_number
 * @property int|null $is_branch
 * @property int $evfdid
 * @property string|null $maker
 * @property string|null $maker_time
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company';
    }

    public static function getEvfdId()
    {
        $company = Company::find()->one();
        if($company != null){
            return $company->evfdid;
        }else{
            return false;
        }
    }

    public static function getDetails()
    {
        $company = Company::find()->one();
        if($company != null){
            return $company;
        }else{
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'evfdid'], 'required'],
            [['is_branch', 'evfdid'], 'integer'],
            [['maker_time'], 'safe'],
            [['name', 'address', 'phone_number', 'maker'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'is_branch' => Yii::t('app', 'Is Branch'),
            'evfdid' => Yii::t('app', 'Evfdid'),
            'maker' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }
}
