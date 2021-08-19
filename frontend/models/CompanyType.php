<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "company_type".
 *
 * @property int $id
 * @property string $name
 * @property string $create_by
 * @property string $created_at
 * @property string|null $updated_at
 */
class CompanyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'create_by', 'created_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'create_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'create_by' => 'Create By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getCompanyType()
    {
        return ArrayHelper::map(CompanyType::find()
            ->all(),'id','name');
    }
}
