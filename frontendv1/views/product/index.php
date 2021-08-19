<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'product_name',
            'description:ntext',
            [
                'attribute' =>  'category',
                'value' => function($model){
                    if($model->category != null){
                        return $model->category0->title;
                    }else{
                        return '';
                    }

                }
            ],
            [
                'attribute' =>  'type_id',
                'value' => function($model){
                    if($model->type_id != null){
                        return $model->type->title;
                    }else{
                        return '';
                    }

                }
            ],
            [
                'attribute' =>  'status',
                'value' => function($model){
                    if($model->status != null){
                        return $model->status;
                    }else{
                        return '';
                    }

                }
            ],
            //'maker_id',
            //'maker_time',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = ['view', 'id' => $model->id];
                        return Html::a('<span class="fas fa-eye"></span>', $url, [
                            'title' => 'Sales',
                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                            // 'class' => 'btn btn-info',

                        ]);


                    },


                ]
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
