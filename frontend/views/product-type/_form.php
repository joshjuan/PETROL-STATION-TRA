<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProductType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-2">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-info']) ?>
        </div>
        <div class="col-sm-2">
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning btn-block']) ?>
        </div>
    </div>
    <hr>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>


    <?php ActiveForm::end(); ?>

</div>
