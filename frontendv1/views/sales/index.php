<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
//use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            //'id',
            'trn_dt',
           // 'session_id',
           [
                   'attribute' => 'product',
                    'value' => function($model){
                        if(empty($model->product)){
                            return 'UNLEADED';
                        }
                    }
           ],
            'volume',
            'price',
            'sub_total',
            'total',
            'pump_no',
            'nozzel_no',
            //'pts_transaction_no',
            'currency',
            //'qr_code:ntext',
            [
                    'attribute' => 'status',
                    'value' => function($model){
                            if($model->status == 3){
                                return 'Signed by TRA';
                            }else{
                                return 'Not signed';
                            }
                    }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = ['view', 'id' => $model->id];
                        return Html::a('<span class="fas fa fa-money">View</span>', $url, [
                            'title' => 'Sales',
                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                            'class' => 'btn btn-success',

                        ]);


                    },


                ]
                ]
        ],
        'striped'=>true,
        'showPageSummary' => true,
        'hover'=>true,
        'toolbar' =>  [
            '{export}',
            '{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'pjaxSettings'=>[
            'neverTimeout'=>true,


        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
