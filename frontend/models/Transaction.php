<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property string|null $trn_date
 * @property string $trn_time
 * @property int|null $transaction_id
 * @property int|null $pump_number
 * @property int|null $nozzel_number
 * @property string|null $product_name
 * @property float|null $volume
 * @property float|null $price
 * @property float|null $amount
 * @property float|null $tax
 * @property float|null $total_amount
 * @property string|null $qr_code
 * @property int|null $status
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trn_date', 'trn_time'], 'safe'],
            [['transaction_id', 'pump_number', 'nozzel_number', 'status'], 'integer'],
            [['volume', 'price', 'amount', 'tax', 'total_amount'], 'number'],
            [['qr_code'], 'string'],
            [['product_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'trn_date' => 'Trn Date',
            'trn_time' => 'Trn Time',
            'transaction_id' => 'Transaction ID',
            'pump_number' => 'Pump #',
            'nozzel_number' => 'Nozzel #',
            'product_name' => 'Product ',
            'volume' => 'Volume',
            'price' => 'Price',
            'amount' => 'Amount',
            'tax' => 'Tax',
            'total_amount' => 'Total',
            'qr_code' => 'Qr Code',
            'status' => 'Status',
        ];
    }
}
