<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "operation_request".
 *
 * @property int $id
 * @property int $operationId
 * @property string $datetime
 * @property string|null $module
 * @property int|null $user
 * @property int|null $company
 * @property string|null $action
 * @property string|null $token
 * @property string|null $status
 * @property string|null $other_data
 */
class OperationRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operation_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['operationId', 'datetime'], 'required'],
            [['operationId', 'user','company'], 'integer'],
            [['datetime'], 'safe'],
            [['module', 'action','token'], 'string', 'max' => 255],
            [['other_data'], 'string'],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'operationId' => 'Operation ID',
            'datetime' => 'Datetime',
            'module' => 'Module',
            'user' => 'User',
            'action' => 'Action',
            'status' => 'Status',
        ];
    }

    public static function getOperationId(){
        $search = OperationRequest::find()
            ->max('operationId');
        $checkLast = OperationRequest::find()
            ->orderBy(['operationId' => SORT_DESC])
            ->one();
        if ($search != null) {
          return  $currentId = $checkLast['operationId'] + 1;

        } else {
          return  $currentId = 1;
        }
    }
}
