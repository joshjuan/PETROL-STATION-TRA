<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property string|null $trn_dt
 * @property int|null $session_id
 * @property string|null $product
 * @property float|null $volume
 * @property float|null $price
 * @property float|null $sub_total
 * @property float|null $tax
 * @property float|null $total
 * @property int|null $pump_no
 * @property int|null $nozzel_no
 * @property int|null $pts_transaction_no
 * @property string|null $currency
 * @property string|null $qr_code
 * @property string|null $signature
 * @property int|null $status
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trn_dt'], 'safe'],
            [['session_id', 'pump_no', 'nozzel_no', 'pts_transaction_no', 'status'], 'integer'],
            [['volume', 'price', 'sub_total', 'total','tax'], 'number'],
            [['qr_code'], 'string'],
            [['product'], 'string', 'max' => 255],
            [['currency'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Trn Dt'),
            'session_id' => Yii::t('app', 'Session ID'),
            'product' => Yii::t('app', 'Product'),
            'volume' => Yii::t('app', 'Volume'),
            'price' => Yii::t('app', 'Price'),
            'sub_total' => Yii::t('app', 'Sub Total'),
            'tax' => Yii::t('app', 'Tax'),
            'total' => Yii::t('app', 'Total'),
            'pump_no' => Yii::t('app', 'Pump No'),
            'nozzel_no' => Yii::t('app', 'Nozzel No'),
            'pts_transaction_no' => Yii::t('app', 'Pts Transaction No'),
            'currency' => Yii::t('app', 'Currency'),
            'qr_code' => Yii::t('app', 'Qr Code'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
