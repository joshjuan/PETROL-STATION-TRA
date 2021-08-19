<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "customer_certificate".
 *
 * @property int $id
 * @property string $files
 * @property int $eVFDID
 * @property string $datetime
 */
class CustomerCertificate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_certificate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['files', 'eVFDID', 'datetime'], 'required'],
            [['files'], 'string'],
            [['eVFDID'], 'integer'],
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
            'files' => Yii::t('yii', 'Files'),
            'eVFDID' => Yii::t('yii', 'E Vfdid'),
            'datetime' => Yii::t('yii', 'Datetime'),
        ];
    }
}
