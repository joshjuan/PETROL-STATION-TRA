<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Department */

$this->title = Yii::t('app', 'New Department');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
