<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "renew_licence".
 *
 * @property int $id
 * @property int $valid_licence_id
 * @property string|null $activation_date
 * @property string|null $expired_date
 * @property string|null $created_at
 * @property string|null $status
 * @property int|null $created_by
 */
class RenewLicence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'renew_licence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['valid_licence_id'], 'required'],
            [['valid_licence_id', 'created_by','status'], 'integer'],
            [['activation_date', 'expired_date', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valid_licence_id' => 'Valid Licence ID',
            'activation_date' => 'Activation Date',
            'expired_date' => 'Expired Date',
            'created_at' => 'Date Time',
            'created_by' => 'Activated By',
        ];
    }
}
