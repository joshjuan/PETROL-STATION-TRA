<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UrlConfig */

$this->title = 'Create Url Config';
$this->params['breadcrumbs'][] = ['label' => 'Url Configs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="url-config-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
