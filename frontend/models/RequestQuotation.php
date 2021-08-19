<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "request_quotation".
 *
 * @property int $id
 * @property string $reference_number
 * @property string $order_date
 * @property int $supplier_id
 * @property float|null $sub_total_amount
 * @property float|null $tax
 * @property float|null $total_amount
 * @property int $status
 * @property string|null $maker
 * @property string|null $maker_time
 *
 * @property Supplier $supplier
 * @property RequestQuotationItem[] $requestQuotationItems
 */
class RequestQuotation extends \yii\db\ActiveRecord
{
    const Draft = 0;
    const Purchase_Order = 1;
    const Received = 2;
    const Paid = 3;

    private $_statusLabel;

    /**
     * {@inheritdoc}
     */



    public static function tableName()
    {
        return 'request_quotation';
    }


    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $statuses = self::getArrayStatus();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }


    /**
     * @inheritdoc
     */
    public static function getArrayStatus()
    {
        return [
            self::Draft => Yii::t('app', 'DRAFT'),
            self::Purchase_Order => Yii::t('app', 'PURCHASE ORDER'),
            self::Paid => Yii::t('app', 'PAID'),
            self::Received => Yii::t('app', 'RECEIVED'),
        ];
    }

    public static function getLastReference()
    {
        $model = RequestQuotation::find()->all();

        if ($model != null) {
            $reference = 'PO'.sprintf("%05d", count($model) + 1);
            return $reference;
        } else {

            $reference = 'PO00001';
            return $reference;

        }

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reference_number', 'order_date', 'supplier_id', 'status'], 'required'],
            [['order_date', 'maker_time'], 'safe'],
            [['supplier_id', 'status'], 'integer'],
            [['sub_total_amount', 'tax', 'total_amount'], 'number'],
            [['reference_number', 'maker'], 'string', 'max' => 200],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'reference_number' => Yii::t('app', 'Reference Number'),
            'order_date' => Yii::t('app', 'Order Date'),
            'supplier_id' => Yii::t('app', 'Supplier'),
            'sub_total_amount' => Yii::t('app', 'Sub Total Amount'),
            'tax' => Yii::t('app', 'Tax'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'status' => Yii::t('app', 'Status'),
            'maker' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * Gets query for [[Supplier]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }

    /**
     * Gets query for [[RequestQuotationItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestQuotationItems()
    {
        return $this->hasMany(RequestQuotationItem::className(), ['request_quotation_id' => 'id']);
    }
}
