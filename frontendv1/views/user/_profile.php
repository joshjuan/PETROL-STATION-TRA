<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\User;
$this->title = 'My Profile';
?>
<div class="employee-view">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
        <div class="employee-form">
            <div class="panel panel-default">
                <div class="panel-heading">Employee Form</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($emp, 'first_name')->textInput(['maxlength' => true,'placeholder' => 'Enter first name']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($emp, 'middle_name')->textInput(['maxlength' => true, 'placeholder' => 'Enter middle name']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($emp, 'last_name')->textInput(['maxlength' => true, 'placeholder' => 'Enter last name']) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <?= $form->field($emp, 'date_of_birth')->widget(DatePicker::ClassName(),
                                [
                                    //'name' => 'purchase_date',
                                    // 'value' => date('d-M-Y', strtotime('+2 days')),
                                    'options' => ['placeholder' => 'Enter date of birth'],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true
                                    ]
                                ]);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($emp, 'job_title_id')->dropDownList(\backend\models\JobTitle::getAll(),['prompt'=>Yii::t('app','--Select Job Title--'),'disabled' => 'disabled']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($emp, 'branch_id')->dropDownList(\backend\models\Branch::getAll(),['prompt'=>Yii::t('app','--Select branch--'),'disabled' => 'disabled']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                    <?= $form->field($emp, 'department_id')->dropDownList(\backend\models\Department::getAll(),['prompt'=>Yii::t('app','--Select department--'),'disabled' => 'disabled']) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        <div class="col-md-6">

    <div class="user-form">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Yii::t('app', 'Login Details'); ?>
            </div>
            <div class="panel-body">


                <?= $form->field($model, 'username')->textInput(['maxlength' => 255,'readonly'=>'readonly']) ?>
                <?= $form->field($model, 'role')->dropDownList(User::getArrayRole(),['disabled'=>'disabled']) ?>

                <?= $form->field($model, 'status')->dropDownList(User::getArrayStatus(),['disabled'=>'disabled']) ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255]) ?>

                <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 255]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Change Password'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
        </div>
</div>
