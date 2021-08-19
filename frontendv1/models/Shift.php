<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shift".
 *
 * @property int $id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property int $employee_id
 * @property int $pump_id
 * @property int $nozzle_id
 * @property string|null $maker_id
 * @property string|null $maker_time
 *
 * @property Employee $employee
 */
class Shift extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shift';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['day', 'start_time', 'end_time', 'employee_id','pump_id'], 'required'],
            [['start_time', 'end_time', 'maker_time'], 'safe'],
            [['employee_id','pump_id','nozzle_id'], 'integer'],
            [['day', 'maker_id'], 'string', 'max' => 200],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['pump_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pump::className(), 'targetAttribute' => ['pump_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'day' => Yii::t('app', 'Day'),
            'start_time' => Yii::t('app', 'Start Time'),
            'end_time' => Yii::t('app', 'End Time'),
            'employee_id' => Yii::t('app', 'Employee'),
            'pump_id' => Yii::t('app', 'Pump'),
            'nozzle_id' => Yii::t('app', 'Nozzle'),
            'maker_id' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * Gets query for [[Employee]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }


    /**
     * Gets query for [[Pump]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPump()
    {
        return $this->hasOne(Pump::className(), ['id' => 'pump_id']);
    }

    /**
     * Gets query for [[Nozzle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNozzle()
    {
        return $this->hasOne(Nozzel::className(), ['id' => 'nozzle_id']);
    }
}
