
<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<div class="user-form" style="padding-top: 2%;">
    <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-4">
            <div class="panel-heading">
                <?= Yii::t('app', ' UPDATE COMPANY DETAILS'); ?>
            </div>
        </div>
        <div class="col-sm-4">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'tin')->textInput(['autofocus' => true,'readOnly'=>true]) ?>

        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'serial_number')->textInput(['autofocus' => true,'readOnly'=>true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'vrn')->textInput(['autofocus' => true,'readOnly'=>true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-3">
            <?= $form->field($model, 'uin')->textInput(['autofocus' => true,'readOnly'=>true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'tax_office')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-3">
            <?= $form->field($model, 'business_licence')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true,'readOnly'=>true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'status')->dropDownList(\frontend\models\Company::getCompanyStatus(),['prompt' => '--Select--']) ?>
        </div>
        <div class="col-sm-3">
            <p>
                <?= Html::a('Create Auth Item Child', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?= $form->field($model, 'company_id_type')->dropDownList(\frontend\models\CompanyType::getCompanyType(),['prompt'=>'Select Type']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
             <?= $form->field($model, 'company_username')->textInput(['maxlength' => true, 'readOnly'=>true]) ?>
        </div>
      <div class="col-sm-3">
             <?= $form->field($model, 'certificate_serial')->textInput(['maxlength' => true,]) ?>
        </div>
            <div class="col-sm-3">
             <?= $form->field($model, 'password')->passwordInput(['maxlength' => true,'readOnly'=>true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'pfx_file')->fileInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-info']) ?>
        </div>
        <div class="col-sm-2">
            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning btn-block']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<hr>


