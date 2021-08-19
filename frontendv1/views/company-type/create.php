<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\CompanyType */

$this->title = 'New Company Type';
$this->params['breadcrumbs'][] = ['label' => 'Company Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-type-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
