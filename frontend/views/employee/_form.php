<?php

use frontend\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form container-fluid" style="background: white; padding: 10px">
<div class="panel panel-primary" >
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'department_id')->dropDownList(\frontend\models\Department::getAll(),['prompt' => '--Select--']) ?>

    <?php
    if($model->isNewRecord)
    {?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($user, 'username')->textInput(['maxlength' => 255, 'placeholder' => 'Enter username']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($user, 'email')->textInput(['maxlength' => 255, 'placeholder' => 'Enter email']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($user, 'password')->passwordInput(['maxlength' => 255, 'placeholder' => 'Enter password']) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($user, 'repassword')->passwordInput(['maxlength' => 255, 'placeholder' => 'Confirm password']) ?>
            </div>
        </div>


        <?= $form->field($user, 'role')->dropDownList(User::getArrayRole(),['prompt'=>Yii::t('app','--Select--')]) ?>


    <?php } ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
