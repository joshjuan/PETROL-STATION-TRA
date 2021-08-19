<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ReceivedProduct */

$this->title = Yii::t('app', 'Create Received Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Received Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="received-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
