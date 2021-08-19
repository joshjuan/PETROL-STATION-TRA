<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "received_product".
 *
 * @property int $id
 * @property string $received_date
 * @property int $purchase_order_id
 * @property int $product_id
 * @property float $quantity
 * @property float $received
 * @property float $balance
 * @property int|null $status
 * @property string|null $maker
 * @property string|null $maker_time
 *
 * @property Product $product
 * @property RequestQuotation $purchaseOrder
 */
class ReceivedProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'received_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['received_date', 'purchase_order_id', 'product_id', 'quantity', 'received', 'balance'], 'required'],
            [['received_date', 'maker_time'], 'safe'],
            [['purchase_order_id', 'product_id', 'status'], 'integer'],
            [['quantity', 'received', 'balance'], 'number'],
            [['maker'], 'string', 'max' => 200],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['purchase_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestQuotation::className(), 'targetAttribute' => ['purchase_order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'received_date' => Yii::t('app', 'Received Date'),
            'purchase_order_id' => Yii::t('app', 'Purchase Order ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'received' => Yii::t('app', 'Received'),
            'balance' => Yii::t('app', 'Balance'),
            'status' => Yii::t('app', 'Status'),
            'maker' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[PurchaseOrder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrder()
    {
        return $this->hasOne(RequestQuotation::className(), ['id' => 'purchase_order_id']);
    }
}
