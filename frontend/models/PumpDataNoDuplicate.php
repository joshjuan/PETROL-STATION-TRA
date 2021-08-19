<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pump_data_no_duplicate".
 *
 * @property int $id
 * @property string $pump_data
 * @property string|null $transID
 * @property int|null $transaction
 * @property int|null $eVFDID
 * @property string|null $PtsId
 * @property string|null $qrCode
 * @property int $status
 * @property string $date_time
 */
class PumpDataNoDuplicate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pump_data_no_duplicate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pump_data', 'status', 'date_time'], 'required'],
            [['pump_data'], 'string'],
            [['transaction', 'eVFDID', 'status'], 'integer'],
            [['date_time'], 'safe'],
            [['transID', 'PtsId', 'qrCode'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pump_data' => Yii::t('app', 'Pump Data'),
            'transID' => Yii::t('app', 'Trans ID'),
            'transaction' => Yii::t('app', 'Transaction'),
            'eVFDID' => Yii::t('app', 'E Vfdid'),
            'PtsId' => Yii::t('app', 'Pts ID'),
            'qrCode' => Yii::t('app', 'Qr Code'),
            'status' => Yii::t('app', 'Status'),
            'date_time' => Yii::t('app', 'Date Time'),
        ];
    }
}
