<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Nozzel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nozzel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pump_id')->dropDownList(\frontend\models\Pump::getAll(),['prompt' => '--Select--']) ?>

    <?= $form->field($model, 'grade_id')->dropDownList(\frontend\models\Grade::getAll(),['prompt' => '--Select--']) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
