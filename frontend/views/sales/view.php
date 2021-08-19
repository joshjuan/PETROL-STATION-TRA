<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Sales */

$this->title = \frontend\models\Grade::getNameById(\frontend\models\Nozzel::getGradeIdByNozzelNo($model->nozzel_no)).' '. $model->volume.' x '. $model->price .' = '. $model->total;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sales-view">

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
           // 'id',
            'trn_dt',
            //'session_id',
           [
                   'attribute' =>  'product',
                   'value' => \frontend\models\Grade::getNameById(\frontend\models\Nozzel::getGradeIdByNozzelNo($model->nozzel_no))
           ],
            'volume',
            'price',
            'sub_total',
            'total',
            'pump_no',
            'nozzel_no',
            'pts_transaction_no',
            'currency',
            'qr_code:ntext',
            'status',
        ],
    ]) ?>

</div>
