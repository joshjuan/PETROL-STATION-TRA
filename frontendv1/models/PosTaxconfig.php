<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pos_taxconfig".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string $taxCode
 * @property string $taxName
 * @property int $taxPercent
 * @property string $taxCategoryName
 * @property string $taxCategoryCode
 * @property int $taxId
 * @property string $datetime
 */
class PosTaxconfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pos_taxconfig';
    }

    public static function getDefault()
    {
        $default = PosTaxconfig::find()->one();
       return $default->taxName;
    }

    public static function getAll()
    {
        return ArrayHelper::map(PosTaxconfig::find()->all(),'taxPercent','taxName');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'taxPercent', 'taxId'], 'integer'],
            [['taxCode', 'taxName', 'taxPercent', 'taxCategoryName', 'taxCategoryCode', 'taxId', 'datetime'], 'required'],
            [['datetime'], 'safe'],
            [['taxCode'], 'string', 'max' => 10],
            [['taxName', 'taxCategoryName', 'taxCategoryCode'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'taxCode' => Yii::t('app', 'Tax Code'),
            'taxName' => Yii::t('app', 'Tax Name'),
            'taxPercent' => Yii::t('app', 'Tax Percent'),
            'taxCategoryName' => Yii::t('app', 'Tax Category Name'),
            'taxCategoryCode' => Yii::t('app', 'Tax Category Code'),
            'taxId' => Yii::t('app', 'Tax ID'),
            'datetime' => Yii::t('app', 'Datetime'),
        ];
    }
}
