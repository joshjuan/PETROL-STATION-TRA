<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ZReportDataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Z Report Data');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zreport-data-index">

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $pdfHeader = [
        'L' => [
            'content' => 'PSMS REPORTS',
        ],
        'C' => [
            'content' => 'Z REPORT',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'color' => '#333333'
        ],
        'R' => [
            'content' => 'Downloaded at:'. date('Y-m-d H:i:s'),
        ],
        'line' => true,
    ];

    $pdfFooter = [
        'L' => [
            'content' => '&copy; Web Technologies (T) LTD',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'C' => [
            'content' => '',
        ],
        'R' => [
            //'content' => 'RIGHT CONTENT (FOOTER)',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'line' => true,
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' =>  'datetime',

                'width'=>'200px',
            ],
            'znumber',
            'fiscal_code',
            'vatrate',
            [
                'attribute' => 'nettamount',
                'pageSummary'=>true,
                'format' => ['decimal',2]
            ],
            [
                'attribute' =>   'discount',
                'pageSummary'=>true,
                'format' => ['decimal',2]
            ],
            [
                'attribute' =>   'taxamount',
                'pageSummary'=>true,
                'format' => ['decimal',2]
            ],
            [
                'attribute' =>  'pmtamount',
                'pageSummary'=>true,
                'format' => ['decimal',2]
            ],


            'pmttype',


            //'status',
            //'ackmsg:ntext',

            ['class' => 'yii\grid\ActionColumn'],
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
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'SALES REPORT',
            'before'=>'<span class="text text-primary">' .$this->render('_z_report', ['model' => $searchModel]).'</span>',
        ],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        'exportConfig' => [
            GridView::PDF => [
                'label' => Yii::t('app', 'PDF'),
                //'icon' => $isFa ? 'file-pdf-o' : 'floppy-disk',
                'iconOptions' => ['class' => 'text-danger'],
                'showHeader' => true,
                'showPageSummary' => true,
                'showFooter' => true,
                'showCaption' => true,
                'filename' => Yii::t('app', 'PSMS - Z-reports'),
                'alertMsg' => Yii::t('app', 'The PDF export file will be generated for download.'),
                'options' => ['title' => Yii::t('app', 'Portable Document Format')],
                'mime' => 'application/pdf',
                'config' => [
                    'mode' => 'c',
                    'format' => 'A4-L',
                    'destination' => 'D',
                    'marginTop' => 20,
                    'marginBottom' => 20,
                    'cssInline' => '.kv-wrap{padding:20px;}' .
                        '.kv-align-center{text-align:center;}' .
                        '.kv-align-left{text-align:left;}' .
                        '.kv-align-right{text-align:right;}' .
                        '.kv-align-top{vertical-align:top!important;}' .
                        '.kv-align-bottom{vertical-align:bottom!important;}' .
                        '.kv-align-middle{vertical-align:middle!important;}' .
                        '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                        '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',

                    'methods' => [
                        'SetHeader' => [
                            ['odd' => $pdfHeader, 'even' => $pdfHeader]
                        ],
                        'SetFooter' => [
                            ['odd' => $pdfFooter, 'even' => $pdfFooter]
                        ],
                    ],

                    'options' => [
                        'title' => 'PDF export generated',
                        'subject' => Yii::t('app', 'PDF export generated by kartik-v/yii2-grid extension'),
                        'keywords' => Yii::t('app', 'krajee, grid, export, yii2-grid, pdf')
                    ],
                    'contentBefore'=>'',
                    'contentAfter'=>''
                ]
            ],
            GridView::CSV => [
                'label' => 'CSV',
                'filename' => 'PSMS - Z REPORT',
                'options' => ['title' => 'PSMS REPORTS'],
            ],
        ],

    ]);
    ?>


    <?php Pjax::end(); ?>

</div>
