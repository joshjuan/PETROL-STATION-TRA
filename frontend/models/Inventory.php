<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "inventory".
 *
 * @property int $id
 * @property int $product_id
 * @property float $buying_price
 * @property float $selling_price
 * @property float $qty
 * @property int|null $min_level
 * @property string|null $last_updated
 * @property string $maker_id
 * @property string $maker_time
 * @property string|null $auth_status
 * @property string $checker_id
 * @property string $checker_time
 *
 * @property Product $product
 */
class Inventory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inventory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['product_id', 'buying_price', 'selling_price', 'qty', 'maker_id', 'maker_time', 'checker_id', 'checker_time'], 'required'],
            [['product_id', 'min_level'], 'integer'],
            [['buying_price', 'selling_price', 'qty'], 'number'],
            [['last_updated', 'maker_time', 'checker_time'], 'safe'],
            [['maker_id', 'checker_id'], 'string', 'max' => 200],
            [['auth_status'], 'string', 'max' => 1],
            [['product_id'], 'unique'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product'),
            'buying_price' => Yii::t('app', 'Buying Price'),
            'selling_price' => Yii::t('app', 'Selling Price'),
            'qty' => Yii::t('app', 'Available Quantity'),
            'min_level' => Yii::t('app', 'Min Level'),
            'last_updated' => Yii::t('app', 'Last Updated'),
            'maker_id' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
            'auth_status' => Yii::t('app', 'Auth Status'),
            'checker_id' => Yii::t('app', 'Checker '),
            'checker_time' => Yii::t('app', 'Checker Time'),
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
}
