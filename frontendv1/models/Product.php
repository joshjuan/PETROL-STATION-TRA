<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $product_name
 * @property string|null $description
 * @property int $category
 * @property int $type_id
 * @property int $status
 * @property string $maker_id
 * @property string $maker_time
 *
 * @property Cart[] $carts
 * @property Inventory $inventory
 * @property PriceMaintenance[] $priceMaintenances
 * @property Category $category0
 * @property ProductType $type
 * @property ProductAttribute[] $productAttributes
 * @property ProductReturn[] $productReturns
 * @property Purchase[] $purchases
 * @property SalesItem[] $salesItems
 * @property StockAdjustment[] $stockAdjustments
 * @property StoreInventory[] $storeInventories
 * @property TransferredGood[] $transferredGoods
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public static function getAll()
    {

        return ArrayHelper::map(Product::find()->all(),'id', 'product_name');
    }

    public static function getNameById($id)
    {
        $product = Product::findOne(['id' => $id]);
        if($product != null){
            return $product->product_name;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_name', 'category', 'type_id'], 'required'],
            [['description'], 'string'],
            [['category', 'type_id', 'status'], 'integer'],
            [['maker_time'], 'safe'],
            [['product_name', 'maker_id'], 'string', 'max' => 200],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_name' => Yii::t('app', 'Product Name'),
            'description' => Yii::t('app', 'Description'),
            'category' => Yii::t('app', 'Category'),
            'type_id' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'maker_id' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Inventory]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInventory()
    {
        return $this->hasOne(Inventory::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[PriceMaintenances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceMaintenances()
    {
        return $this->hasMany(PriceMaintenance::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(ProductType::className(), ['id' => 'type_id']);
    }

    /**
     * Gets query for [[ProductAttributes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(ProductAttribute::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductReturns]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductReturns()
    {
        return $this->hasMany(ProductReturn::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Purchases]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchases()
    {
        return $this->hasMany(Purchase::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[SalesItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesItems()
    {
        return $this->hasMany(SalesItem::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[StockAdjustments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockAdjustments()
    {
        return $this->hasMany(StockAdjustment::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[StoreInventories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStoreInventories()
    {
        return $this->hasMany(StoreInventory::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[TransferredGoods]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransferredGoods()
    {
        return $this->hasMany(TransferredGood::className(), ['product_id' => 'id']);
    }
}
