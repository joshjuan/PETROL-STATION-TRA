<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ZReportData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zreport-data-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'fiscal_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'znumber')->textInput() ?>

    <?= $form->field($model, 'vatrate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nettamount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'taxamount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pmttype')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pmtamount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'datetime')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'ackmsg')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
