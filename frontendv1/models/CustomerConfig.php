<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "customer_config".
 *
 * @property int $id
 * @property int $type
 * @property string $response
 * @property int $eVFDID
 * @property string $datetime
 */
class CustomerConfig extends \yii\db\ActiveRecord
{
    const GETCONFIG = 1;
    const GETSTATUS = 2;
    const OPENDAY = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'response', 'eVFDID', 'datetime'], 'required'],
            [['type', 'eVFDID'], 'integer'],
            [['response'], 'string'],
            [['datetime'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'type' => Yii::t('yii', 'Type'),
            'response' => Yii::t('yii', 'Response'),
            'eVFDID' => Yii::t('yii', 'E Vfdid'),
            'datetime' => Yii::t('yii', 'Datetime'),
        ];
    }
}
