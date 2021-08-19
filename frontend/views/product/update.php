<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = Yii::t('app', 'Update Product: {name}', [
    'name' => $model->product_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
