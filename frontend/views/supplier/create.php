<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Supplier */

$this->title = Yii::t('app', 'Add Supplier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suppliers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
