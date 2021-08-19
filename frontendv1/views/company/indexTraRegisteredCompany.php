<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List of Registered Company To TRA';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index" style="padding-top: 25px">

    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        'name',
        //'company_username',
        'tin',
        'vrn',
        // 'certificate_serial',
        'serial_number',
        'uin',
        //'tax_office',
        // 'address',
        // 'email:email',
        // 'business_licence',
        'contact_person',
//        [
//            'attribute' => 'company_id_type',
//            'value' => 'companyType.name'
//        ],
        [
            'attribute' => 'status',
            'value' => 'companyStatus.name'
        ],

        'create_by',
        'created_at',
        //'updated_at',
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => '{view}',
            // 'visible' => yii::$app->user->can('applyForUinCertificate'),
            'buttons' => [
                'view' => function ($url, $model) {
                    $url = ['view-registered-company', 'id' => $model->id];
                    return Html::a('<span class="fa fa-eye"></span>', $url, [
                        'title' => 'View',
                        'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                        'class' => 'btn btn-primary',

                    ]);


                },

            ]
        ],


    ];


    // the GridView widget (you must use kartik\grid\GridView)
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'id' => 'grid',
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export'] // remove this row from export
            ]
        ],

        'pjax' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        //   'floatHeader' => true,

        //   'floatHeaderOptions' => ['scrollingTop' => true],
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_ACTIVE,
            'heading' => '',
            'before' => '<span class="text text-primary">' . Html::a('Back', ['/'], ['class' => 'btn btn-warning']) . '</span>',
        ],
        'rowOptions' => function ($model) {
            return ['data-id' => $model->id];
        },
        'exportConfig' => [
            GridView::EXCEL => [
                'filename' => Yii::t('app', 'companies-') . date('Y-m-d'),
                'showPageSummary' => true,
                'options' => [
                    'title' => 'Custom Title',
                    'subject' => 'PDF export',
                    'keywords' => 'pdf'
                ],

            ],

        ],

    ]); ?>

</div>





