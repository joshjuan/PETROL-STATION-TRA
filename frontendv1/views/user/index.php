<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\User;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?= Yii::$app->session->getFlash('success'); ?>

    <p>
        <?php // Html::a(Yii::t('app', 'Add ') . Yii::t('app', 'User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= \fedemotta\datatables\DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            'role',

            //'created_at',

            [
                'attribute'=>'user_id',
                'label' => 'Full name',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a(Html::encode(\frontend\models\Employee::getFullNameByEmpID($data->user_id)),['employee/view','id' => $data->user_id]);
                },
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                   return $model->statusLabel;
                },
            ],



            ['class' => 'yii\grid\ActionColumn','header'=>'Actions'],
        ],
    ]); ?>

</div>
