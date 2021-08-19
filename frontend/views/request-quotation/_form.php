<?php

use kartik\date\DatePicker;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RequestQuotation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-quotation-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Save') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-info' : 'btn btn-info']) ?>

            <?= Html::a(Yii::t('app', 'Cancel'), ['index'], ['class' => 'btn btn-warning']) ?>
        </div>
    </div>
    <hr>
    <div class="card">
    <div class="card-body">
<div class="panel panel-primary">
 <div class="row">
     <div class="col-md-12">
         <h1><?= \frontend\models\RequestQuotation::getLastReference() ?></h1>
     </div>
 </div>
    <div class="row">
        <div class="col-md-1">
            Supplier
        </div>
        <div class="col-md-5">
            <?php  \yii\widgets\Pjax::begin(['id' => 'load-suppliers'])?>
            <?= $form->field($model, "supplier_id")->widget(Select2::classname(), [
                'data' => \frontend\models\Supplier::getAll(),
                'language' => 'en',
                'options' => ['class' => 'showModalButton','id' => 'supplier-id'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])->label(false);?>
            <?php // print_r(\frontend\models\Supplier::getAll());?>
            <?php \yii\widgets\Pjax::end()?>
        </div>
        <div class="col-md-2 text-right">
            Order Date
        </div>
        <div class="col-md-4">
           <?= $form->field($model, 'order_date')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Order date'],
            'pluginOptions' => [
            'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
            ])->label(false);?>
        </div>
    </div>
    <p></p>
    <p><br/></p>
    <div class="row">
        <div class="col-md-12">
            <div class="padding-v-md">
                <div class="line line-dashed"></div>
            </div>

    <?php
    DynamicFormWidget::begin([

        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $items[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            //  'sponsorship_id',
            'request_quotation_id',
            'sub_total_amount',
            'tax'

        ],
    ]);
    ?>

    <div class="panel-body" style="font-size: 0.85em"><!-- widgetContainer -->

        <div>
            <table class="container-items table table-striped">
                <thead >
                <tr>
                    <th>Item Description</th>
                    <th>Quantity</th>
                    <th> Unit Price</th>
                    <th>Taxes</th>
                    <th>Sub Total</th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>

                </thead>


            <?php foreach ($items as $index=>$item): ?>


                <?php
                // necessary for update action.
                if (!$item->isNewRecord) {
                    echo Html::activeHiddenInput($item, "[{$index}]id");
                }
                ?>
            <tbody>
                <tr class="item">

                    <td><?= $form->field($item, "[{$index}]product_id")->dropDownList(\frontend\models\Product::getAll(),['prompt' => '--Product--'])->label(false) ?></td>
                    <td><?= $form->field($item, "[{$index}]quantity")->textInput(['maxlength' => true,'options' => ['class' => 'col-sm-1'],'placeholder' => '','onkeyup' => 'totales($(this))'])->label(false) ?></td>

                    <td><?= $form->field($item, "[{$index}]unit_price")->textInput(['maxlength' => true,['options' => ['border'=> 'none']],'placeholder' => '','onkeyup' => 'totales($(this))'])->label(false) ?></td>
                    <td><?= $form->field($item, "[{$index}]tax")->dropDownList(\frontend\models\PosTaxconfig::getAll(),['prompt' => '--NoTax--','onchange' => 'totales($(this))'])->label(false) ?></td>
                    <td><?= $form->field($item, "[{$index}]sub_total")->textInput(['maxlength' => true,'readonly' => 'readonly',['options' => ['border'=> 'none']],'placeholder' => '','onkeyup' => 'totales($(this))'])->label(false) ?></td>
                    <td><?= $form->field($item, "[{$index}]tax_id")->hiddenInput(['maxlength' => true,'options' => ['class' => 'col-sm-1'],'placeholder' => '','onkeyup' => 'totales($(this))'])->label(false) ?></td>
                        <td colspan="3">
                            <button type="button" class="add-item btn-xs text-blue"><i class="fa fa-plus"></i></button>
                            <button type="button" class="remove-item btn-xs text-red"><i class="fa fa-minus"></i></button>
                        </td>




                </tr>



            <?php endforeach; ?>
            </tbody>
            </table>
            <?php DynamicFormWidget::end(); ?>
        </div>

        <div class="panel-heading">
            <div class="row" >
                <div class="col-md-8 text-right">
                    <b>Untaxed Amount:</b>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'sub_total_amount')->textInput()->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 text-right">
                    <b>Taxes:</b>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'tax')->textInput()->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 text-right">
                    <b>Taxed Amount:</b>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'total_amount')->textInput()->label(false) ?>
                </div>
            </div>



            </div>


        </div>
    </div>


</div>
</div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
    <script>
        function totales(item){
            var total_amount = 0;
            var tax_amount = 0;
            var index  = item.attr("id").replace(/[^0-9.]/g, "");
            var qty = $('#requestquotationitem-' + index + '-quantity').val();
            qty = qty == "" ? 0 : Number(qty.split(",").join(""));
            var price = $('#requestquotationitem-' + index + '-unit_price').val();
            price = price == "" ? 0 : Number(price.split(",").join(""));
            var tax = $('#requestquotationitem-' + index + '-tax').val();
            tax = tax == "" ? 0 : Number(tax.split(",").join(""));
            $('#requestquotationitem-' + index + '-sub_total').val(qty * price);
            $('#requestquotationitem-' + index + '-tax_id').val(qty * price*tax/100);

            // total_amount =total_amount + (qty * price);
            //  $('#sponsorship-total_amount').val(total_amount);

            id = 0;
            sum = 0;
            sumTax = 0;
            exist = true;
            while(exist){
                var idFull = "requestquotationitem-"+id+"-sub_total";
                var idFullTax = "requestquotationitem-"+id+"-tax_id";
                try{
                    campo = document.getElementById(idFull);
                    if(document.getElementById(idFull).value!=""){
                        sum = sum + parseInt(document.getElementById(idFull).value);
                    }
                    if(document.getElementById(idFullTax).value!=""){
                        sumTax = sumTax + parseInt(document.getElementById(idFullTax).value);
                    }
                    id = id+1;
                }catch(e){
                    exist = false;
                }
            }
            document.getElementById("requestquotation-tax").value=sumTax;
            document.getElementById("requestquotation-sub_total_amount").value=sum;
            document.getElementById("requestquotation-total_amount").value=sum + sumTax;



        }


    </script>

