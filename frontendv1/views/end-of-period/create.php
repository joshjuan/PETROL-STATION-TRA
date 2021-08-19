<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\EndOfPeriod */

$this->title = Yii::t('app', 'Create End Of Period');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'End Of Periods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="end-of-period-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
