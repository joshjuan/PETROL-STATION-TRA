<?php

use frontend\models\RequestQuotation;
use kartik\form\ActiveForm;

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\RequestQuotation */



$this->title = $model->reference_number.'/'. $model->statusLabel;
if($model->status == RequestQuotation::Draft){
    $link = 'requests';
}elseif ($model->status == RequestQuotation::Purchase_Order){
    $link = 'orders';
}
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Quotations'), 'url' => [$link]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="request-quotation-view">

        <?php
        if($model->status == RequestQuotation::Purchase_Order) {
            Modal::begin([
                'title' => '<h2 class="text-left">Receive Products</h2>',
                'toggleButton' => ['label' => 'Receive Products', 'class' => 'btn btn-info'],
                'size' => Modal::SIZE_LARGE,
                'options' => ['class' => 'slide'],
            ]);
            ?>
            <div class="text-left">
                <?php $form = ActiveForm::begin(
                    ['type' => ActiveForm::TYPE_HORIZONTAL, 'formConfig' => ['labelSpan' => 3], 'action' => ['contract-payment/create']]); ?>


                <div class="row text-right">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        <button type="submit" class="btn btn-danger " data-dismiss="modal"><span class="fa fa-times"></span> Close</button>

                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <?php

            Modal::end();



        }


        ?>







        <?php
        if($model->status == \frontend\models\RequestQuotation::Draft) {
            echo Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ])
            .' '.
             Html::a(Yii::t('app', 'Confirm'), ['confirm', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to confirm this item?'),
                    'method' => 'post',
                ],
            ]);
        }?>
    <hr/>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'reference_number',
            'order_date',
            [
                'attribute' => 'supplier_id',
                'value' => function($model){
                    return $model->supplier->supplier_name;
                }
            ],
        ],
    ]) ?>
    <table class="container-items table table-condensed">
        <thead >
        <tr>
            <th>Item Description</th>
            <th>Quantity</th>
            <th> Unit Price</th>
            <th>Taxes</th>
            <th>Sub Total</th>
        </tr>

        </thead>
        <tbody>
        <?php
        $items = \frontend\models\RequestQuotationItem::find()->where(['request_quotation_id' => $model->id])->all();
        $fmt = Yii::$app->formatter;
        if($items != null){
            foreach ($items as $item){
                echo '<tr>
                      <td>'.$item->description.'</td>
                      <td>'.$item->quantity.'</td>
                      <td>'.$fmt->asDecimal($item->unit_price,2).'</td>
                      <td>'.$fmt->asDecimal($item->tax,2).'</td>
                      <td>'.$fmt->asDecimal($item->sub_total,2).'</td>

                    </tr>';
            }
        }
        ?>
        <tr style="background: #dee2e6">
            <td colspan="3"></td>
            <th class="text-right">Untaxed Amount:</th>
            <td><?= $fmt->asDecimal($model->sub_total_amount,2) ?></td>
        </tr>
        <tr  style="background: #dee2e6">
            <td colspan="3"></td>
            <th class="text-right">Taxes:</th>
            <td><?= $fmt->asDecimal($model->tax,2) ?></td>
        </tr>
        <tr  style="background: #dee2e6">
            <td colspan="3"></td>
            <th class="text-right">Taxed Amount:</th>
            <td ><?= $fmt->asDecimal($model->total_amount,2) ?></td>
        </tr>
        </tbody>
    </table>

</div>
