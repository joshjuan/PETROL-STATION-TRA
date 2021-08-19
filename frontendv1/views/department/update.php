<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Department */

$this->title = Yii::t('app', 'Update Department: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="department-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
