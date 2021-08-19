<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = $model->product_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

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
            'maker_id',
            'maker_time',
        ],
    ]) ?>

</div>
