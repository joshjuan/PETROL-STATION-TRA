<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create ') . Yii::t('app', 'Role'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'name',
                ],
                'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'template' => '{view}{edit}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        $url = ['role/view', 'name' => $model->name];
                        return Html::a('<span class="fas fa-eye"></span>', $url, [
                            'title' => 'roles',
                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                            //'class' => 'btn btn-info',

                        ]);


                    },
                    'edit' => function ($url, $model) {
                        $url = ['role/update', 'name' => $model->name];
                        return Html::a('  <span class="fas fa-pencil-alt"></span>', $url, [
                            'title' => 'roles',
                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                          //  'class' => 'btn btn-info',

                        ]);


                    },

                    'delete' => function ($url, $model) {
                        $url = ['role/delete', 'name' => $model->name];
                        return Html::a('  <span class="fas fa-times"></span>', $url, [
                            'title' => 'roles',
                            'data-toggle' => 'tooltip', 'data-original-title' => 'Save',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],

                        ]);


                    },



                ]
            ],
        ],
    ]); ?>

</div>
