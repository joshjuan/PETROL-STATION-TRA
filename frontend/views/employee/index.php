<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'designation',
           [
                   'attribute' =>  'department_id',
                    'value' => function($model){
                        return $model->department->name;
                    }
           ],
            'maker_id',
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
                            'class' => 'btn btn-info',

                        ]);


                    },


                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
