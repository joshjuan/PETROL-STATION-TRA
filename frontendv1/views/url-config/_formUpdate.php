<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UrlConfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="url-config-form panel panel-primary">


    <?php $form = ActiveForm::begin(); ?>
    <div class="col-sm-12 no-padding">
        <div class="row">

            <div class="col-sm-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'readOnly'=>true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'prefix_url')->textInput(['maxlength' => true,'placeholder'=>'https://']) ?>
            </div>

            <div class="col-sm-3">
                <?= $form->field($model, 'domain_name')->textInput(['maxlength' => true,'placeholder'=>'xxx.co.tz']) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'post_fix')->textInput(['maxlength' => true,'placeholder'=>'/api/___']) ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($model, 'url')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
            </div>


            <div class="form-group" style="padding-left: 1%">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                <?= Html::a('go Back', ['index',], ['class' => 'btn btn-warning']) ?>
            </div>

        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>

