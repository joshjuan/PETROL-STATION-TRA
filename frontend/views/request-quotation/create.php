<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RequestQuotation */

$this->title = Yii::t('app', 'Request for quotation').'/ '.\frontend\models\RequestQuotation::getLastReference();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request For Quotations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-quotation-create">


    <?= $this->render('_form', [
        'model' => $model,'items' => $items
    ]) ?>

</div>
