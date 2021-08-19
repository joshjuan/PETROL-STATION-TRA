<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RequestQuotationItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-quotation-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'request_quotation_id')->textInput() ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maker_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
