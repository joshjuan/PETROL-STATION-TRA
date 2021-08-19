<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\ZReportData */

$this->title = Yii::t('app', 'Create Z Report Data');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Z Report Datas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zreport-data-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
