<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pos_sales".
 *
 * @property int $id
 * @property string $trn_dt
 * @property string $reference_number
 * @property float $total_qty
 * @property float $tax
 * @property float|null $discount
 * @property float $sub_total_amount
 * @property float $total_amount
 * @property string|null $customer_name
 * @property float $due_amount
 * @property int $payment_method
 * @property string|null $notes
 * @property string $maker_id
 * @property string $maker_time
 * @property string|null $status
 *
 * @property SalesItem[] $salesItems
 */
class PosSales extends \yii\db\ActiveRecord
{
    const Draft = 0;
    const Sales_Order = 1;
    const Delivered = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pos_sales';
    }



    public static function getLastReference()
    {
        $model = PosSales::find()->all();

        if ($model != null) {
            $reference = 'SO'.sprintf("%05d", count($model) + 1);
            return $reference;
        } else {

            $reference = 'SO00001';
            return $reference;

        }

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trn_dt', 'reference_number', 'total_qty', 'tax', 'sub_total_amount', 'total_amount', 'due_amount', 'payment_method', 'maker_id', 'maker_time'], 'required'],
            [['trn_dt', 'maker_time'], 'safe'],
            [['total_qty', 'tax', 'discount', 'sub_total_amount', 'total_amount', 'due_amount'], 'number'],
            [['payment_method'], 'integer'],
            [['reference_number', 'customer_name', 'notes', 'maker_id'], 'string', 'max' => 200],
            [['status'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trn_dt' => Yii::t('app', 'Sales date'),
            'reference_number' => Yii::t('app', 'Reference Number'),
            'total_qty' => Yii::t('app', 'Total Qty'),
            'tax' => Yii::t('app', 'Tax'),
            'discount' => Yii::t('app', 'Discount'),
            'sub_total_amount' => Yii::t('app', 'Sub Total Amount'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'customer_name' => Yii::t('app', 'Customer Name'),
            'due_amount' => Yii::t('app', 'Due Amount'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'notes' => Yii::t('app', 'Notes'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[SalesItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesItems()
    {
        return $this->hasMany(SalesItem::className(), ['sales_id' => 'id']);
    }
}
