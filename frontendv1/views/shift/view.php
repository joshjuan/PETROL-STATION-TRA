<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Shift */

$this->title = 'Shift Details';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shifts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="shift-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          //  'id',
            'day',
            'start_time',
            'end_time',
           [
                   'attribute' =>  'employee_id',
                    'value' => $model->employee->name,
           ],
            [
                'attribute' =>  'pump_id',
                'value' => $model->pump->name,
            ],
            [
                'attribute' =>  'nozzle_id',
                'value' => $model->nozzle->name,
            ],
            'maker_id',
            'maker_time',
        ],
    ]) ?>

</div>
