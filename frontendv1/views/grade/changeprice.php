<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Grade */

$this->title = Yii::t('app', 'Change Grade Price');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grade-create">


    <?= $this->render('_form_ajax', [
        'model' => $model,
    ]) ?>

</div>
