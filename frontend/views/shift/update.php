<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Shift */

$this->title = Yii::t('app', 'Update Shift: {name}', [
    'name' => $model->day,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shifts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shift-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
