<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\SalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['z-report'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


<div class="row">
    <div class="col-md-5">
        <?= $form->field($model, 'date1')->widget(\janisto\timepicker\TimePicker::className(), [
            //'language' => 'fi',
            'mode' => 'datetime',
            'options' => ['placeholder' => 'Start date time'],
            'clientOptions'=>[
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'HH:mm:ss',
                'showSecond' => true,
            ]
        ])->label(false);?>
    </div>
    <div class="col-md-5">
        <?= $form->field($model, 'date2')->widget(\janisto\timepicker\TimePicker::className(), [
            //'language' => 'fi',
            'mode' => 'datetime',
            'options' => ['placeholder' => 'End date time'],
            'clientOptions'=>[
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'HH:mm:ss',
                'showSecond' => true,


            ]
        ])->label(false);?>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        </div>
    </div>
</div>







    <?php ActiveForm::end(); ?>

</div>
