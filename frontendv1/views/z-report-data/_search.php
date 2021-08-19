<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ZReportDataSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zreport-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'fiscal_code') ?>

    <?= $form->field($model, 'znumber') ?>

    <?= $form->field($model, 'vatrate') ?>

    <?php // echo $form->field($model, 'nettamount') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'taxamount') ?>

    <?php // echo $form->field($model, 'pmttype') ?>

    <?php // echo $form->field($model, 'pmtamount') ?>

    <?php // echo $form->field($model, 'datetime') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'ackmsg') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
