<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $sale_id
 * @property string $ref_no
 * @property string $transaction_date
 * @property float $amount_in
 * @property float $amount_out
 * @property int $payment_method
 * @property int|null $physical_code
 * @property int $created_by
 * @property int $status
 * @property string $created_at
 * @property string|null $updated_at
 */
class Transactions extends \yii\db\ActiveRecord
{
    const DATA_SENT = 1;
    const DATA_NOT_SENT = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'sale_id', 'ref_no', 'transaction_date', 'amount_in', 'payment_method', 'created_by', 'created_at'], 'required'],
            [['customer_id', 'sale_id', 'payment_method', 'physical_code', 'created_by', 'status'], 'integer'],
            [['transaction_date', 'created_at', 'updated_at'], 'safe'],
            [['amount_in', 'amount_out'], 'number'],
            [['ref_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'sale_id' => 'Sale ID',
            'ref_no' => 'Ref No',
            'transaction_date' => 'Transaction Date',
            'amount_in' => 'Amount In',
            'amount_out' => 'Amount Out',
            'payment_method' => 'Payment Method',
            'physical_code' => 'Physical Code',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }
}
