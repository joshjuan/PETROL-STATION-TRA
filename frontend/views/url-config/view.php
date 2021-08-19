<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\UrlConfig */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Url Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="url-config-view">

    <p>

        <?= Html::a('Update', ['update', 'id' => $model->id], [
            'class' => 'btn btn-info',
            'data' => [
                'confirm' => 'Are you sure you want to update this URL configuration?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('go Back', ['index',], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'name',
            'prefix_url:url',

            'domain_name',
            'post_fix',
            'url:url',
            'created_at',
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy->username,
            ],
        ],
    ]) ?>

</div>
