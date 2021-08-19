<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'trn_dt') ?>

    <?= $form->field($model, 'session_id') ?>

    <?= $form->field($model, 'product') ?>

    <?= $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'sub_total') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'pump_no') ?>

    <?php // echo $form->field($model, 'nozzel_no') ?>

    <?php // echo $form->field($model, 'pts_transaction_no') ?>

    <?php // echo $form->field($model, 'currency') ?>

    <?php // echo $form->field($model, 'qr_code') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
