<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Nozzel */

$this->title = Yii::t('app', 'Add Nozzel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nozzels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nozzel-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
