<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id
 * @property string $supplier_name
 * @property string|null $email
 * @property string $phone_number
 * @property string|null $location
 *
 * @property PurchaseInvoice[] $purchaseInvoices
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    public static function getAll()
    {
        $suppliers = Supplier::find()->count();
        if($suppliers == 0) {
            return array_merge(ArrayHelper::map(Supplier::find()->all(), 'id', 'supplier_name'), [0 => "Create new"]);
        }else{
            $list[] = ArrayHelper::map(Supplier::find()->all(), 'id', 'supplier_name');
            $newList = [$list];
            $newList[1] = [$suppliers + 1 => "Create new"];
            return array_merge($newList[0],$newList[1]);
        }
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['supplier_name', 'phone_number'], 'required'],
            [['supplier_name', 'email', 'phone_number', 'location'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'supplier_name' => Yii::t('app', 'Supplier Name'),
            'email' => Yii::t('app', 'Email'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'location' => Yii::t('app', 'Location'),
        ];
    }

    /**
     * Gets query for [[PurchaseInvoices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseInvoices()
    {
        return $this->hasMany(PurchaseInvoice::className(), ['supplier_id' => 'id']);
    }
}
