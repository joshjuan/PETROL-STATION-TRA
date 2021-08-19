<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\models\Supplier */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(
    [
        'options' => [
            'id' => 'create-new-form'
        ]
    ]
); ?>

<div class="supplier-form">
    <div class="panel">

    <div class="panel-body">

        <?= $form->field($model, 'supplier_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-3 pull-left">

                    <?= Html::submitButton('Create',['class' => 'btn btn-primary btn-block']) ?>
                </div>
            </div>
        </div>
    </div>
    </div>


</div>
<?php ActiveForm::end(); ?>
<?php $script = <<< JS
var form =jQuery("#create-new-form");
//alert(form);

form.on('beforeSubmit', function(e) {
e.preventDefault();
jQuery.ajax({
url: form.attr('action'),
type: form.attr('method'),
data: new FormData(form[0]),
mimeType: 'multipart/form-data',
contentType: false,
cache: false,
processData: false,
dataType: 'json',
success: function (data) {
//alert('ID: '+data.id + ' someOtherData:' + data.someOtherData);
//document.getElementById('supplier-id').value = data.id;
$(document).find('#modal').modal('hide');
$.pjax.reload({container:'#load-suppliers'});
}
});
return false;
});
JS;
$this->registerJs($script);
?>

