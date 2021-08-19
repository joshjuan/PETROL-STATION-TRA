<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = "";
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['in-active-company']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8" style="alignment: left">
            <div class="panel-heading">
                <h3 style="color: blue"><?= Yii::t('app', Html::encode($model->name) . ' COMPANY DETAILS'); ?></h3>
            </div>
        </div>
        <div class="col-sm-2">
        </div>
    </div>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Back home', ['/company/active-company'], ['class' => 'btn btn-warning']) ?>

    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //  'id',
            'name',
             'company_username',
            'tin',
            'vrn',
            'certificate_serial',
                'serial_number',
            'uin',
            'tax_office',
            'address',
            'street',
            'city',
            'country',
            'email:email',
            'business_licence',
            'contact_person',
            [
                'attribute' => 'company_id_type',
                'value' => $model->companyType->name
            ],
            [
                'attribute' => 'status',
                'value' => $model->companyStatus->name
            ],
            'create_by',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
