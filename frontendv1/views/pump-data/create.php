<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PumpData */

$this->title = Yii::t('app', 'Create Pump Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pump Datas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pump-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
