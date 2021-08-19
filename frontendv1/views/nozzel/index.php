<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NozzelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nozzels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nozzel-index">

    <p>
        <?= Html::a(Yii::t('app', 'Add Nozzel'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'name',
           [
                   'attribute' => 'pump_id',
                    'value' => 'pump.name'
           ],
            [
                'attribute' => 'grade_id',
                'value' => 'grade.name'
            ],
            //'maker',
            //'maker_time',

            ['class' => 'yii\grid\ActionColumn','header' => 'Actions'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
