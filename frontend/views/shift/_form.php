<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Shift */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>
<div id="loader1" style="display: none"></div>
<div class="row">
    <div class="col-sm-2">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-block btn-success' : 'btn btn-block btn-info']) ?>
    </div>
    <div class="col-sm-2">
        <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning btn-block']) ?>
    </div>
</div>
<div class="shift-form" style="background: white; padding: 10px;margin-top: 10px">



<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'day')->textInput(['maxlength' => true]) ?>
    </div>
</div>

    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'start_time')->widget(\janisto\timepicker\TimePicker::className(), [
                //'language' => 'fi',
                'mode' => 'datetime',
                'clientOptions'=>[
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'HH:mm:ss',
                    'showSecond' => true,
                ]
            ]);?>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'end_time')->widget(\janisto\timepicker\TimePicker::className(), [
                //'language' => 'fi',
                'mode' => 'datetime',
                'clientOptions'=>[
                    'dateFormat' => 'yy-mm-dd',
                    'timeFormat' => 'HH:mm:ss',
                    'showSecond' => true,
                ]
            ]);?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'employee_id')->dropDownList(\frontend\models\Employee::getAll(),['prompt' => '--Select--']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            <?= $form->field($model, 'pump_id')->dropDownList(\frontend\models\Pump::getAll(),['prompt' => '--Select--']) ?>
        </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

            <?= $model->isNewRecord ?
                $form->field($model, 'nozzle_id')->dropDownList(['promp' => '--Select--'])
                :
                $form->field($model, 'nozzle_id')->dropDownList(\frontend\models\Nozzel::getAllByPumpId($model->pump_id),['prompt' => '--Select--'])
            ;
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
