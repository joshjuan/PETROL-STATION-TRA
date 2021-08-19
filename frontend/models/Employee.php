<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property string $designation
 * @property int $department_id
 * @property string|null $maker_id
 * @property string|null $maker_time
 *
 * @property Department $department
 * @property Shift[] $shifts
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    public static function getFullNameByEmpID($emp_id)
    {
        $employee = Employee::findOne($emp_id);

        if($employee != null){
            return $employee->name;
        }else{
            return '';
        }
    }

    public static function getAll()
    {
        return ArrayHelper::map(Employee::find()->all(),'id','name');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'designation', 'department_id'], 'required'],
            [['department_id'], 'integer'],
            [['maker_time'], 'safe'],
            [['name', 'designation', 'maker_id'], 'string', 'max' => 200],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'designation' => Yii::t('app', 'Designation'),
            'department_id' => Yii::t('app', 'Department'),
            'maker_id' => Yii::t('app', 'Maker'),
            'maker_time' => Yii::t('app', 'Maker Time'),
        ];
    }

    /**
     * Gets query for [[Department]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * Gets query for [[Shifts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShifts()
    {
        return $this->hasMany(Shift::className(), ['employee_id' => 'id']);
    }
}
