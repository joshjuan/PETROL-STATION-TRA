<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sales_item".
 *
 * @property int $id
 * @property string $trn_dt
 * @property int $sales_id
 * @property int $product_id
 * @property int $tax_id
 * @property float|null $selling_price
 * @property float|null $qty
 * @property float $tax
 * @property float|null $total
 * @property float|null $previous_balance
 * @property float|null $balance
 * @property string $maker_id
 * @property string $maker_time
 * @property string|null $delete_stat
 *
 * @property Product $product
 * @property PosSales $sales
 */
class SalesItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */



    public static function tableName()
    {
        return 'sales_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trn_dt', 'sales_id', 'product_id', 'tax', 'maker_id', 'maker_time',], 'required'],
            [['trn_dt', 'maker_time'], 'safe'],
            [['sales_id', 'product_id','tax_id'], 'integer'],
            [['selling_price', 'qty', 'tax', 'total', 'previous_balance', 'balance'], 'number'],
            [['maker_id'], 'string', 'max' => 200],
            [['delete_stat'], 'string', 'max' => 1],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => PosSales::className(), 'targetAttribute' => ['sales_id' => 'id']],
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
            'sales_id' => Yii::t('app', 'Sales ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'qty' => Yii::t('app', 'Qty'),
            'tax' => Yii::t('app', 'Tax'),
            'total' => Yii::t('app', 'Total'),
            'previous_balance' => Yii::t('app', 'Previous Balance'),
            'balance' => Yii::t('app', 'Balance'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'delete_stat' => Yii::t('app', 'Delete Stat'),
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
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(PosSales::className(), ['id' => 'sales_id']);
    }

    /**
     * Gets query for [[PosTaxConfig]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxId()
    {
        return $this->hasOne(PosTaxconfig::className(), ['id' => 'tax_id']);
    }
}
