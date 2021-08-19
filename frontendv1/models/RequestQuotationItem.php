<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "request_quotation_item".
 *
 * @property int $id
 * @property int $request_quotation_id
 * @property int $product_id
 * @property string|null $description
 * @property int $quantity
 * @property float $unit_price
 * @property float|null $tax
 * @property float|null $sub_total
 * @property string|null $maker
 * @property string|null $maker_time
 *
 * @property RequestQuotation $requestQuotation
 */
class RequestQuotationItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $tax_id;

    public static function tableName()
    {
        return 'request_quotation_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_quotation_id', 'product_id', 'quantity', 'unit_price'], 'required'],
            [['request_quotation_id', 'product_id', 'quantity'], 'integer'],
            [['unit_price', 'tax', 'sub_total'], 'number'],
            [['maker_time'], 'safe'],
            [['description', 'maker'], 'string', 'max' => 200],
            [['request_quotation_id'], 'exist', 'skipOnError' => true, 'targetClass' => RequestQuotation::className(), 'targetAttribute' => ['request_quotation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'request_quotation_id' => Yii::t('app', 'Request Quotation ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'description' => Yii::t('app', 'Description'),
            'quantity' => Yii::t('app', 'Quantity'),
            'unit_price' => Yii::t('app', 'Unit Price'),
            'tax' => Yii::t('app', 'Tax'),
            'sub_total' => Yii::t('app', 'Sub Total'),
            'maker' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * Gets query for [[RequestQuotation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestQuotation()
    {
        return $this->hasOne(RequestQuotation::className(), ['id' => 'request_quotation_id']);
    }
}
