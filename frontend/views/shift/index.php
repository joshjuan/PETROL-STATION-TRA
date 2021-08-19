<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ShiftSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Shifts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shift-index">


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

           // 'id',
            'day',
            'start_time',
            'end_time',
            [
                'attribute' =>  'employee_id',
                'value' => function($model){
                    return $model->employee->name;
                }
            ],
            [
                'attribute' =>  'pump_id',
                'value' => function($model){
                    return $model->pump->name;
                }
            ],
            [
                'attribute' =>  'nozzle_id',
                'value' => function($model){
                    return $model->nozzle->name;
                }
            ],

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
                            'class' => 'btn btn-info',

                        ]);


                    },


                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
