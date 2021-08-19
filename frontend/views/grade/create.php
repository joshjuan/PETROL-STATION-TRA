<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Grade */

$this->title = Yii::t('app', 'New Grade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
