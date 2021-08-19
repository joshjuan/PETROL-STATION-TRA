<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PumpData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pump-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pump_data')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'transID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transaction')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'date_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
