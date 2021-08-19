<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EndOfPeriod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="end-of-period-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'previous_working_day')->textInput() ?>

    <?= $form->field($model, 'current_working_day')->textInput() ?>

    <?= $form->field($model, 'next_working_day')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
