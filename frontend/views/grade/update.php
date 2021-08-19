<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Grade */

$this->title = Yii::t('app', 'Update Grade: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="grade-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
