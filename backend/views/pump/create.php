<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pump */

$this->title = Yii::t('app', 'Create Pump');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pumps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pump-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
