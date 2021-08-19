<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UrlConfig */

$this->title = 'Update Url Config: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Url Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="url-config-update">

    <?= $this->render('_formUpdate', [
        'model' => $model,
    ]) ?>

</div>
