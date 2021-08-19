<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "end_of_period".
 *
 * @property int $id
 * @property string|null $previous_working_day
 * @property string|null $current_working_day
 * @property string|null $next_working_day
 */
class EndOfPeriod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'end_of_period';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['previous_working_day', 'current_working_day', 'next_working_day'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'previous_working_day' => 'Previous Working Day',
            'current_working_day' => 'Current Working Day',
            'next_working_day' => 'Next Working Day',
        ];
    }
}
