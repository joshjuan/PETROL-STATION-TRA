<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UrlConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List of URL configured';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-index" style="padding-top: 25px">

    <p>
        <?php Html::a('Add Url Config', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php $gridColumns = [
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        'name',
        'prefix_url:url',

        'domain_name',
        'post_fix',
        'url:url',
        [
            'attribute' => 'created_at',
            'width' => '98px'
        ],
        [
            'attribute' => 'created_by',
            'value' => 'createdBy.username',
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => '{view}',
            // 'visible' => yii::$app->user->can('applyForUinCertificate'),
            'buttons' => [
                'view' => function ($url, $model) {
                    $url = ['view', 'id' => $model->id];
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
            'heading' => 'List of Companies',
            // 'before' => '<span class="text text-primary">' . Html::a('Back', ['/'], ['class' => 'btn btn-warning']) . '</span>',
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





