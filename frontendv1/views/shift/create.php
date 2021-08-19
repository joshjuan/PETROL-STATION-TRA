<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Shift */

$this->title = Yii::t('app', 'New Shift');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shifts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shift-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
