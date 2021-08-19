<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RequestQuotationItem */

$this->title = Yii::t('app', 'Create Request Quotation Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Quotation Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-quotation-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
