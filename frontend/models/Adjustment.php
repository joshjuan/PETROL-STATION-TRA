<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "adjustment".
 *
 * @property int $id
 * @property int $transferred_good_id
 * @property float $total_qty
 * @property float $adjusted_stock
 * @property float $transferred_qty
 * @property string $comment
 * @property string|null $maker_id
 * @property string|null $maker_time
 *
 * @property TransferredGood $transferredGood
 */
class Adjustment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adjustment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['transferred_good_id', 'total_qty', 'adjusted_stock', 'transferred_qty', 'comment'], 'required'],
            [['transferred_good_id'], 'integer'],
            [['total_qty', 'adjusted_stock', 'transferred_qty'], 'number'],
            [['maker_time'], 'safe'],
            [['comment', 'maker_id'], 'string', 'max' => 200],
            [['transferred_good_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransferredGood::className(), 'targetAttribute' => ['transferred_good_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transferred_good_id' => Yii::t('app', 'Transferred Good ID'),
            'total_qty' => Yii::t('app', 'Total Qty'),
            'adjusted_stock' => Yii::t('app', 'Adjusted Stock'),
            'transferred_qty' => Yii::t('app', 'Transferred Qty'),
            'comment' => Yii::t('app', 'Comment'),
            'maker_id' => Yii::t('app', 'Maker ID'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * Gets query for [[TransferredGood]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransferredGood()
    {
        return $this->hasOne(TransferredGood::className(), ['id' => 'transferred_good_id']);
    }
}
