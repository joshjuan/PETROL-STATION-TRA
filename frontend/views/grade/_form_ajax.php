<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\models\Grade */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="grade-form">
    <div class="panel">

    <div class="panel-body">
        <?php
        $grades = \frontend\models\Grade::find()->all();
        if($grades != null){
            foreach ($grades as $key=>$grade){

                // necessary for update action.
                echo  $form->field($model, "[{$grade->id}]price")->textInput(['maxlength' => true,'required'=>true])->label($grade->name. ' ('.$grade->price. ')') ;
            }
        }
        ?>


        <div class="form-group">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3 pull-left">

                    <?= Html::submitButton(Yii::t('app', 'Change'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
    </div>


</div>
<?php ActiveForm::end(); ?>


